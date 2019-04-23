<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    //
        public $timestamps = false;

     protected $table = 'answer';
 
     public function event() {
         return $this->belongsTo('App\Question');
     }
}
