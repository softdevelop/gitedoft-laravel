<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentFilm extends Model
{
    //
    protected $fillable = [
        'user_id', 'film_id', 'content',
    ];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function film()
    {
    	return $this->belongsTo('App\Film');
    }
}
