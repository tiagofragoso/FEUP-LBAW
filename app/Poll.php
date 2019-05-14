<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    //
    public $timestamps = false;

    public function pollOptions() {
        return $this->hasMany('App\PollOption', 'post_id', 'post_id');
    }
}
