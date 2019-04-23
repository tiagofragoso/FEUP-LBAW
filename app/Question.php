<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{

     public $timestamps = false;

     protected $table = 'questions';
 
     public function event() {
         return $this->belongsTo('App\Event');
     }

}
