<?php

namespace App\Policies;

use App\User;
use App\Event;
use App\Ticket;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class EventPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the event.
     * 
     * @param \App\User $user
     * @param  \App\Event  $event
     * @return mixed
     */
    public function view(User $user, Event $event)
    {
        if ($event->banned) {
            return ($user->is_admin);
        } else if ($event->private) {
            return $event->participatesAs(['Owner', 'Host', 'Artist', 'Participant'])->contains($user);
        } 
        return true;
    }

    /**
     * Determine whether the user can create events.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return Auth::check();
    }

    /**
     * Determine whether the user can update the event.
     *
     * @param  \App\User  $user
     * @param  \App\Event  $event
     * @return mixed
     */
    public function update(User $user, Event $event)
    {
        $canEdit = $event->hosts()->get();
        return $canEdit->contains($user);
    }

    /**
     * Determine whether the user can delete the event.
     *
     * @param  \App\User  $user
     * @param  \App\Event  $event
     * @return mixed
     */
    public function delete(User $user, Event $event)
    {
        //
    }

    public function acquireTicket(User $user,Event $event){
        
        $canAcquire = $event->participatesAs(['Participant'])->get();
        return $canAcquire->contains($user) && !Ticket::where('owner', $user->id)->where('event_id', $event->id)->exists();
    }

    public function canVote(User $user, Event $event){

        $canVote = $event->participatesAs(['Owner', 'Host','Artist','Participant'])->get();
        return $canVote->contains($user);
    }
}
