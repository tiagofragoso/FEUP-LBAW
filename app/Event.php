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

    public function participations() {
        return $this->hasMany('App\Participation', 'event_id');
    }

    public function hosts() {
        return $this->participations()->get()->whereIn('type', ['Host', 'Owner'])
            ->mapToGroups(function($part) {
                return [$part['type'] => $part->user()->first()];
            });
    }

    public function artists() {
        return $this->participations()->get()->where('type', 'Artist')->map(function($part) { return $part->user()->first(); });
    }

    public function posts($id){
        $posts = $this->hasMany('App\Posts', 'event_id')->get()->where('event_id',$id);

        foreach($posts as $post)
        {   

            
            $post['allComments'] = $this->hasMany('App\Comments','post_id')->get()->where('post_id', $post->id);
        }
     return $posts;
    }
}