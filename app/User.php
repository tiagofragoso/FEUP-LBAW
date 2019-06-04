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
        'name', 'username', 'email', 'password', 'is_admin', 'birthdate','banned'
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

    public function following() {
        return $this->belongsToMany('App\User', 'follows', 'follower_id', 'followed_id');
    }

    public function follow($user_id) {
        return $this->following()->attach($user_id);
    }

    public function unfollow($user_id) {
        return $this->following()->detach($user_id);
    }

    public function hasFollow($user_id) {
        return $this->following()->wherePivot('followed_id', $user_id)->exists();
    }

    public function joinEvent($event_id, $type) {
        return $this->events($type)->attach($event_id, ['type' => $type]);
    }

    public function hasParticipation($event_id, $type) {
        if (!is_array($type))
            $type = [$type];
        return $this->events($type)->wherePivot('event_id', $event_id)->wherePivotIn('type', $type)->exists();
    }

    public function leaveEvent($event_id, $type) {
        return $this->events($type)->detach($event_id);
    }

    public function reports(){
        return $this->hasMany('App\UserReport','reported_user');
    }

    public function likePost($post_id){
        $this->belongsToMany('App\Post','post_likes','user_id','post_id')
             ->attach($post_id);
       
    }

    public function dislikePost($post_id){
        $this->belongsToMany('App\Post','post_likes','user_id','post_id')
             ->detach($post_id);
       
    }

    public function likeComment($comment_id){
        $this->belongsToMany('App\Comment','comment_likes','user_id','comment_id')
             ->attach($comment_id);
       
    }

    public function dislikeComment($comment_id){
        $this->belongsToMany('App\Comment','comment_likes','user_id','comment_id')
             ->detach($comment_id);
       
    }

}
