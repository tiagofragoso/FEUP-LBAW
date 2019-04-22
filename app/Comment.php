<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{ 
    public $timestamps = false;

    public function author() {
        return $this->belongsTo('App\User');
    }

    public function post() {
        return $this->belongsTo('App\Post');
    }

}
