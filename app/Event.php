<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //
    public $timestamps = false;

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'participants', 'banned', 'search'
    ];

    public function users() {
        return $this->belongsToMany('App\User', 'participations')->withPivot('type');
    }

    public function user($id) {
        return $this->belongsToMany('App\User', 'participations')->wherePivot('user_id', $user);
    }
}