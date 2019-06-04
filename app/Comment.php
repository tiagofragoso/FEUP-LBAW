<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public $timestamps = false;
    protected $table = 'comments';

    protected $guarded = [
        'likes', 'parent'
    ];

    public function comments() {
        return $this->hasMany('App\Comment', 'parent')->orderBy('date', 'asc');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function likes(){
        return $this->belongsToMany('App\User','comment_likes','comment_id','user_id');
    }

    public function hasLike($user) {
        return $this->likes()->wherePivot('user_id', $user)->exists();
    }


}
