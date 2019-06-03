<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventReport extends Model
{
    //
        public $timestamps = false;

     protected $table = 'event_reports';
     protected $fillable = ['status'];
 
     public function event(){
        return $this->hasOne('App\Event','id','event_id');
    }
    public function user(){
        return $this->hasMany('App\User','id','user_id');
    }

}

