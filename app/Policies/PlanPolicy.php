<?php

namespace App\Policies;

use App\User;
use App\Agency\Service\Plan;
use Illuminate\Auth\Access\HandlesAuthorization;

class PlanPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the plan.
     *
     * @param  \App\User  $user
     * @param  \App\Application\Plan  $plan
     * @return mixed
     */
    public function view(User $user, Plan $plan)
    {
        return true;
        //
    }

    /**
     * Determine whether the user can create plans.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->role == 'geziwen' || $user->role == 'agency';
        //
    }

    /**
     * Determine whether the user can update the plan.
     *
     * @param  \App\User  $user
     * @param  \App\Application\Plan  $plan
     * @return mixed
     */
    public function update(User $user, Plan $plan)
    {
        $agency = $user->agency;
        return $user->role == 'geziwen'|| ($user->role == 'agency' && $user->link == $agency->id);//
    }

    /**
     * Determine whether the user can delete the plan.
     *
     * @param  \App\User  $user
     * @param  \App\Application\Plan  $plan
     * @return mixed
     */
    public function delete(User $user, Plan $plan)
    {
        $agency = $user->agency;
        return $user->role == 'geziwen'|| ($user->role == 'agency' && $user->link == $agency->id);
        //
    }
}
