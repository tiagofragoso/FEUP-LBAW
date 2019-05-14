<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public $timestamps = false;

    protected $guarded = [
        'likes', 'parent'
    ];

    public function comments() {
        return $this->hasMany('App\Comment', 'parent');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

}
