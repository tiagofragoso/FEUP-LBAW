<?php

namespace App\Policies;

use App\User;
use App\EventReport;
use App\UserReport;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReportPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the eventReport.
     *
     * @param  \App\User  $user
     * @param  \App\EventReport  $eventReport
     * @return mixed
     */
    public function view(User $user, EventReport $eventReport)
    {
        
    }

    /**
     * Determine whether the user can create eventReports.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return Auth::check();
    }

    /**
     * Determine whether the user can update the eventReport.
     *
     * @param  \App\User  $user
     * @param  \App\EventReport  $eventReport
     * @return mixed
     */
    public function update(User $user, EventReport $eventReport)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the eventReport.
     *
     * @param  \App\User  $user
     * @param  \App\EventReport  $eventReport
     * @return mixed
     */
    public function delete(User $user, EventReport $eventReport)
    {
        //
    }
}
