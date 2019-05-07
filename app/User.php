<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    public $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password', 'is_admin', 'birthdate'
    ];

    /**
     * The attributes that should be visible for arrays.
     *
     * @var array
     */
    protected $visible = [
        'name', 'username', 'email', 'birthdate', 'followers', 'following'
    ];


    public function events($type) {
        if (!is_array($type))
            $type = [$type];
        return $this->belongsToMany('App\Event', 'participations')->withPivot('type')->wherePivotIn('type', $type);
    }

    public function displayName() {
        return (empty($this->name)? '@'.$this->username : $this->name);
    }

    public function event($id) {
        return $this->belongsToMany('App\Event', 'participations')->wherePivot('event_id', $id);
    }

    public function eventsParticipation($events) {
        foreach ($events as $key => $value) {
            if ($this->event($value->id)->get()->isEmpty()) {
                $value['joined'] = false;
            } else {
                $value['joined'] = true;
            }
        }
        return $events;
    }
    
    

}
