<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ThreadComment extends Model
{
    //
    public $timestamps = false;

    public $table = 'thread_comments';

    protected $fillable = [
        'content', 'thread_id', 'user_id'
    ];


    public function user() {
        return $this->belongsTo('App\User');
    }
}
