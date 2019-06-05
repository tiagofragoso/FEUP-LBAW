<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{

     public $timestamps = false;

     protected $table = 'questions';

     protected $fillable = [
        'event_id', 'content'
     ];
 
     public function event() {
         return $this->belongsTo('App\Event');
     }

     public function answer() {
         return $this->hasOne('App\Answer');
     }

}
