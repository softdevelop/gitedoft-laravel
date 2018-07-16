<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Film;
use App\CommentFilm;
use Validator;
use JWTAuth;

class FilmController extends Controller
{
	private $film;

    public function __construct(Film $film)
    {
        $this->film = $film;
    }

	public function createImageFromBase64($data)
    {
        if(base64_decode(preg_replace('#^data:image/\w+;base64,#i', '',$data),true)){
            $file_data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '',$data));
            $file_name = 'image_' . time() . '_' . str_random(5) . '.png';
            $fullPathFile = Film::PHOTO . $file_name;
            Storage::disk('public')->put($file_name, $file_data);

            // $file_data->move('upload/img', $file_name); //?????????
            // $file = $request->photo;
            // $file->move('upload/img', $file->getClientOriginalName());
            // $file_data->move('upload/img',$file_name);

            return $file_name;
        }else{
            return false;
        }
        
    }

    public function messageValidate($valid)
    {   
        $message = '';
        if (is_array($valid)){ 
            $errors = $valid;
            foreach ($errors as $key => $error) {
                $message = $error[0];
            }
        }
        return $message;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $films = Film::all();
		if ( !$films ) {
			return response()->json([
				'status' => 'error',
			]);
		} 
		return response()->json([
    		'status' => 'success',
    		'data' => [ 'films' => $films ]
    	]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|unique:films',
            'description' => 'required|min:6',
            'realease_date' => 'required',
            'rating' => 'required',
            'ticket_price' => 'required',
            'country' => 'required',
            'genre' => 'required',
        ]);



    	if ($validator->fails()) {
    		return response()->json([
    			'status' => 'error',
    			'msg' => $validator->messages()
            ],401);
        // }
        


        // if($validator->fails()){
        //     $message = $this->messageValidate($validator->errors()->toArray());
        //     return response()->json([
        //         'status' => 'error',
        //         'message' => $message
        //     ]);
            
        }else{
            if ($request->has('photo')) {
                $photo = $this->createImageFromBase64($request['photo']);
                if($photo == false) {
                    return response()->json([
                        'status' => 'error',
                        'message' => "Incorrect base64 code format"
                    ]);
                }
            }

            $film = $this->film->create([
              	'name' => $request['name'],
	            'description' => $request['description'],
	            'realease_date' => $request['realease_date'],
	            'rating' => $request['rating'],
	            'ticket_price' => $request['ticket_price'],
	            'country' => $request['country'],
	            'genre' => $request['genre'],
	            'photo' => $photo,
	            'slug' => str_slug($request['name'])
            ]);
            if (isset($film)) {
                $film = ['film' => $film];
    	        return response()->json([
    	        	'status' => 'success',
                    'message' => "Add film successfully!",
                    'data' => $film
                ]);
            } else {
            	return response()->json([
                    'status' => 'error',
                    'message' => "Add film failing!"
                ]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        //
        $film = Film::where('slug',$slug)->first();
        if ( !$film ) {
			return response()->json([
				'status' => 'error',
			]);
        } 
        //----------------
        $film->comments = $film->comments;
        $itemComment = new \stdClass();
        $comments = array();
        if(count($film->comments))
        {
            foreach($film->comments as $comment)
            {
                $itemComment = $comment;
                $itemComment->name = $comment->user->name;
                array_push($comments,$itemComment);
            }
        }
        //----------
		return response()->json([
    		'status' => 'success',
    		'data' => [ 'film' => $film ]
    	]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function commentFilms(Request $request)
    {
    	$validator = Validator::make($request->all(),[
            'content' => 'required',
        ]);
        
        if($validator->fails()){
            $message = $this->messageValidate($validator->errors()->toArray());
            return response()->json([
                'status' => 'error',
                'message' => $message
            ]);
        }else{
        	$commentFilm = new CommentFilm;
        	$commentFilm->content = $request['content'];
        	$commentFilm->user_id = JWTAuth::toUser($request->token)->id;
			$commentFilm->film_id = $request['film_id'];
			$commentFilm->save();

			return response()->json([
                'status' => 'success',
                'data' => ['commentFilm' => $commentFilm]
            ]);
        }
    }
}
