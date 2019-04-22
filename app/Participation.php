<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participation extends Model
{
    public $timestamps = false;

    protected $table = 'participations';

    public function event() {
        return $this->belongsTo('App\Event');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}


