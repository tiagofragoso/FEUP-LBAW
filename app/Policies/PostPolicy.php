<?php

namespace App\Policies;

use App\User;
use App\Post;
use App\Event;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the post.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function view(User $user, Post $post)
    {
        //
    }

    /**
     * Determine whether the user can create posts.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user, Post $post, Event $event)
    {
        $canCreate = $event->participatesAs(['Owner', 'Host', 'Artist'])->get();
        return $canCreate->contains($user);
    }

    /**
     * Determine whether the user can update the post.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function update(User $user, Post $post)
    {
        $event = Event::where('id',$post->event_id)->get()->first();
        $canCreate = $event->participateAs(['Owner', 'Host', 'Artist','Participant'])->get();
        return $canCreate->contains($user);
        
    }

    /**
     * Determine whether the user can delete the post.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function delete(User $user, Post $post)
    {
        //
    }

}
