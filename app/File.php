<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    //
    public $timestamps = false;
    protected $primaryKey = 'post_id';
    protected $fillable = ['post_id', 'file'];
}
