<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //
    public $timestamps = false;

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'participants', 'banned', 'search'
    ];

    public function posts(){
        return $this->hasMany('App\Post');
    }

    public function participatesAs($type) {
        if (!is_array($type))
            $type = [$type];
        return $this->belongsToMany('App\User', 'participations')->using('App\Participation')->wherePivotIn('type', $type);
    }

    public function questions(){
        return $this->hasMany('App\Question');
    }

    public function currency(){
        return $this->belongsTo('App\Currency', 'currency');
    }

    public function category() {
        return $this->belongsTo('App\Category', 'category');
    }

}