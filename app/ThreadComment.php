<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ThreadComment extends Model
{
    //
    public $timestamps = false;

    public $table = 'thread_comments';

    public function user() {
        return $this->belongsTo('App\User');
    }
}
