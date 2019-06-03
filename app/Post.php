<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    public $timestamps = false;

    protected $guarded = [
        'likes', 'comments'
    ];


    public function event() {
        return $this->belongsTo('App\Event');
    }

    public function author() {
        return $this->belongsTo('App\User');
    }

    public function comments() {
        return $this->hasMany('App\Comment')->where('parent', NULL)->orderBy('date', 'asc');
    }

    public function poll() {
        return $this->hasOne('App\Poll');
    }

    public function file() {
        return $this->hasOne('App\File');
    }

}
