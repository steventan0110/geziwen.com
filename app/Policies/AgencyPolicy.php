<?php

namespace App\Policies;

use App\User;
use App\Agency\Agency;
use Illuminate\Auth\Access\HandlesAuthorization;

class AgencyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the agency.
     *
     * @param  \App\User  $user
     * @param  \App\Agency\Agency  $agency
     * @return mixed
     */
    public function view(User $user, Agency $agency)
    {
        return true;
    }

    /**
     * Determine whether the user can create agencies.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->role == 'geziwen';
    }

    /**
     * Determine whether the user can update the agency.
     *
     * @param  \App\User  $user
     * @param  \App\Agency\Agency  $agency
     * @return mixed
     */
    public function update(User $user, Agency $agency)
    {
        return ($user->role == 'agency' && $user->link == $agency->id)
            || $user->role == 'geziwen' && $agency->manager->id == $user->id;
    }

    /**
     * Determine whether the user can delete the agency.
     *
     * @param  \App\User  $user
     * @param  \App\Agency\Agency  $agency
     * @return mixed
     */
    public function delete(User $user, Agency $agency)
    {
        return $user->role == 'geziwen' && $agency->manager->id == $user->id;
    }
}
