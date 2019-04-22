<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participation extends Model
{

    public $table = 'participations';

    public function event() {
        return $this->belongsTo('App\Event');
    }
}


