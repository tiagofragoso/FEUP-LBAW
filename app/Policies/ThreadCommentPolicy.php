<?php

namespace App\Policies;

use App\User;
use App\ThreadComment;
use App\Event;
use Illuminate\Auth\Access\HandlesAuthorization;

class ThreadCommentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the threadComment.
     *
     * @param  \App\User  $user
     * @param  \App\ThreadComment  $threadComment
     * @return mixed
     */
    public function view(User $user, ThreadComment $threadComment)
    {
        //
    }

    /**
     * Determine whether the user can create threadComments.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user, ThreadComment $comment, Event $event)
    {
        return $event->participatesAs(['Host', 'Owner', 'Artist'])->get()->constains($user);
    }

    /**
     * Determine whether the user can update the threadComment.
     *
     * @param  \App\User  $user
     * @param  \App\ThreadComment  $threadComment
     * @return mixed
     */
    public function update(User $user, ThreadComment $threadComment)
    {
        //
    }

    /**
     * Determine whether the user can delete the threadComment.
     *
     * @param  \App\User  $user
     * @param  \App\ThreadComment  $threadComment
     * @return mixed
     */
    public function delete(User $user, ThreadComment $threadComment)
    {
        //
    }
}
