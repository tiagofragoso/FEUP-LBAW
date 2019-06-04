<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PollVote extends Model
{
    //
    protected  $table = 'poll_votes';
    protected $fillable = ['poll_option'];

}
