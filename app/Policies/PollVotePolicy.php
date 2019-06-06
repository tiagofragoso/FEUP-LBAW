<?php

namespace App\Policies;

use App\User;
use App\PollVote;
use Illuminate\Auth\Access\HandlesAuthorization;

class PollVotePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the pollVote.
     *
     * @param  \App\User  $user
     * @param  \App\PollVote  $pollVote
     * @return mixed
     */
    public function view(User $user, PollVote $pollVote)
    {
        //
    }

    /**
     * Determine whether the user can create pollVotes.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user, PollVote $pollVote, Event $event)
    {
        return $event->participateAs(['Owner', 'Host', 'Artist', 'Participant'])->get()->contains($user);
    }

    /**
     * Determine whether the user can update the pollVote.
     *
     * @param  \App\User  $user
     * @param  \App\PollVote  $pollVote
     * @return mixed
     */
    public function update(User $user, PollVote $pollVote, Event $event)
    {
        return $event->participateAs(['Owner', 'Host', 'Artist', 'Participant'])->get()->contains($user);
    }

    /**
     * Determine whether the user can delete the pollVote.
     *
     * @param  \App\User  $user
     * @param  \App\PollVote  $pollVote
     * @return mixed
     */
    public function delete(User $user, PollVote $pollVote)
    {
        //
    }
}
