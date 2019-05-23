<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserReport extends Model
{
    //
        public $timestamps = false;

     protected $table = 'user_reports';
     protected $fillable = ['status'];

     public function reportedUser(){
        return $this->hasOne('App\User','id','reported_user');
    }
    public function user(){
        return $this->hasMany('App\User','id','user_id');
    }

}
