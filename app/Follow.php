<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Follow extends Model
{
    //
    protected $fillable = array('follower_id', 'followed_id');
    protected $primaryKey = array('follower_id', 'followed_id');

    
    public $timestamps = false;
    protected $table = 'follows';
    
  
    protected function setKeysForSaveQuery(Builder $query)
    {
        return $query->where('follower_id', $this->getAttribute('follower_id'))
            ->where('followed_id', $this->getAttribute('followed_id'));
    }
}
