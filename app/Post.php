<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    public $timestamps = false;


    public function event() {
        return $this->belongsTo('App\Event');
    }

    public function author() {
        return $this->belongsTo('App\User');
    }

    public function comments() {
        return $this->hasMany('App\Comment')->where('parent', NULL);
    }

}
