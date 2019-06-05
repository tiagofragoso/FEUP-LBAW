<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    public $timestamps = false;

    protected $table = 'invite_requests';

    protected $fillable = ['user_id', 'invited_user_id', 'event_id', 'type'];

    public function event() {
        return $this->belongsTo('App\Event', 'event_id');
    }

    public function inviter() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function invitee() {
        return $this->belongsTo('App\User', 'invited_user_id');
    }

}
