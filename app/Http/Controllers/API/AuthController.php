<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Password;
use Validator,App\User,Auth;
class AuthController extends Controller
{
    //
    public function register(Request $request)
    {
    	$credentials = $request->only('name', 'email', 'password');
    	$rules = [
    		'name' => 'required|max:255',
    		'email' => 'required|email|max:255|unique:users',
    		'password' => 'required|min:6|max:20'
    	];
    	$validator = Validator::make($credentials,$rules);
    	if ($validator->fails()) {
    		return response()->json([
    			'status' => 'error',
    			'msg' => $validator->messages()
    		]);
    	}
    	$user = User::create([
    		'name' => $request['name'],
    		'email' => $request['email'],
    		'password' => Hash::make($request['password']) 
    	]);

    	return response()->json([
    		'status' => 'success',
    		'data' => ['user' => $user]
    	]);
    }

    public function login (Request $request)
    {
    	$credentials = $request->only('email','password');
    	$rules = [
    		'email' => 'required|email',
    		'password' => 'required'
    	];
    	$validator = Validator::make($credentials, $rules);
    	if ($validator->fails()) {
    		return response()->json([
    			'status' => 'error',
    			'msg' => $validator->messages()
    		]);
    	}
    	$token = null;
    	try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json([
                	'status' => 'error', 
                	'error' => 'We cant find an account with this credentials. Please make sure you entered the right information and you have verified your email address.'
                ], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json([
            	'status' => 'error', 
            	'error' => 'Failed to login, please try again.'
            ], 500);
        }

        return response()->json([
        	'status' => 'success',
        	'data' => ['token' => $token ]
        ]);
    }

    public function logout(Request $request) {
        $this->validate($request, ['token' => 'required']);
        
        try {
            JWTAuth::invalidate($request->input('token'));
            return response()->json(['success' => true, 'message'=> "You have successfully logged out."]);
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['success' => false, 'error' => 'Failed to logout, please try again.'], 500);
        }
    }

    public function user(Request $request)
    {
    	$user = JWTAuth::toUser($request->token);

    	return response()->json([
    		'status' => 'success',
    		'data' => [ 'user' => $user ]
    	]);
	}
	
	public function listUser()
	{
		$users = User::all();
		if ( !$users ) {
			return response()->json([
				'status' => 'error',
			]);
		} 
		return response()->json([
    		'status' => 'success',
    		'data' => [ 'users' => $users ]
    	]);
	}
}
