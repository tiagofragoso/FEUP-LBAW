<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PollOption extends Model
{
    public $timestamps = false;
    protected $table = 'poll_options';

    protected $fillable = ['post_id', 'name'];
}
