<?php

namespace App\Policies;

use App\User;
use App\Answer;
use Illuminate\Auth\Access\HandlesAuthorization;

class AnswerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the answer.
     *
     * @param  \App\User  $user
     * @param  \App\Answer  $answer
     * @return mixed
     */
    public function view(User $user, Answer $answer)
    {
        //
    }

    /**
     * Determine whether the user can create answers.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user, Answer $answer, Event $event) 
    {
        return $event->participateAs(['Host', 'Owner'])->get()->contains($user);
    }

    /**
     * Determine whether the user can update the answer.
     *
     * @param  \App\User  $user
     * @param  \App\Answer  $answer
     * @return mixed
     */
    public function update(User $user, Answer $answer)
    {
        //
    }

    /**
     * Determine whether the user can delete the answer.
     *
     * @param  \App\User  $user
     * @param  \App\Answer  $answer
     * @return mixed
     */
    public function delete(User $user, Answer $answer)
    {
        //
    }
}
