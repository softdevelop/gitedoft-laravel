<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    //
    protected $fillable = [
		'name','description','realease_date','rating','ticket_price','country','genre','photo','slug'
    ];

    const PHOTO = '/images/photos/';
    // public function genre()
    // {
    // 	return $this->belongsTo('App\Genre');
    // }

    public function comments()
    {
        return $this->hasMany('App\CommentFilm');
    }
}
