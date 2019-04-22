<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{ 
    public $timestamps = false;

    protected $table = 'comments';

    public function event() {
        return $this->belongsTo('App\Event');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function post() {
        return $this->belongsTo('App\Posts');
    }

}
