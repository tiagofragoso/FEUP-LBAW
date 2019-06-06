<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserReport extends Model
{
    //
    public $timestamps = false;

     protected $table = 'user_reports';
     protected $fillable = ['user_id','reported_user','status'];

     public function reportedUser(){
        return $this->belongsTo('App\User', 'reported_user');
    }
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }

}
