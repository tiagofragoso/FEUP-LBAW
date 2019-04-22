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
        'username', 'email', 'password', 'is_admin', 'birthdate'
    ];

    /**
     * The attributes that should be visible for arrays.
     *
     * @var array
     */
    protected $visible = [
        'username', 'email'
    ];

    /**
     * The cards this user owns.
     */

    /* 
    public function cards() {
      return $this->hasMany('App\Card');
    }
    */

    public function participations($type) {
        return $this->hasMany('App\Participation')->where('type', $type);
    }

    public function events() {
        $data['joined'] = $this->participations('Participant')->get();
        $data['joined'] = $data['joined']->map(function ($item, $key) { return $item->event()->get()[0]; });
        $data['hosting']  = $this->participations('Host')->get();
        $data['hosting'] = $data['hosting']->map(function ($item, $key) { return $item->event()->get()[0]; });
        $owner = $this->participations('Owner')->get();
        $owner = $owner->map(function ($item, $key) { return $item->event()->get()[0]; });
        $data['hosting'] = $data['hosting']->merge($owner);
        $data['performing']  = $this->participations('Artist')->get();
        $data['performing'] = $data['performing']->map(function ($item, $key) { return $item->event()->get()[0]; });

        return $data;
    }
}
