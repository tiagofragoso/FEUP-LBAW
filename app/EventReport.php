<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventReport extends Model
{
    //
    public $timestamps = false;

     protected $table = 'event_reports';
     protected $fillable = ['event_id','user_id','status'];
 
     public function event(){
        return $this->belongsTo('App\Event', 'event_id');
    }
    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }

}

