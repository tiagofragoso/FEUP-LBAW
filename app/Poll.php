<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    //
    public $timestamps = false;
    protected $primaryKey = 'post_id';
    protected $table = 'polls';

    public function pollOptions() {
        return $this->hasMany('App\PollOption', 'post_id', 'post_id')->orderBy('votes', 'desc');
    }

    public function hasVote($user_id){
        return $this->belongsToMany('App\User','poll_votes','poll_id','user_id')
        ->wherePivot('user_id',$user_id)->exists();
    }

    public function changeVote($user_id, $poll_option){
        
        $this->belongsToMany('App\User','poll_votes','poll_id','user_id')
        ->updateExistingPivot($user_id,['poll_option'=> $poll_option]);
    }
}
