<?php

namespace App\Policies;

use App\User;
use App\Applicant\Applicant;
use Illuminate\Auth\Access\HandlesAuthorization;

class ApplicantPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the applicant.
     *
     * @param  \App\User  $user
     * @param  \App\Applicant\Applicant  $applicant
     * @return mixed
     */
    public function view(User $user, Applicant $applicant)
    {
        return true;
    }

    /**
     * Determine whether the user can create applicants.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->role == 'agency'
            || $user->role == 'geziwen';

    }

    /**
     * Determine whether the user can update the applicant.
     *
     * @param  \App\User  $user
     * @param  \App\Applicant\Applicant  $applicant
     * @return mixed
     */
    public function update(User $user, Applicant $applicant)
    {
        return ($user->role == 'agency' && $user->link == $applicant->agency->id)
            || $user->role == 'geziwen';
    }

    /**
     * Determine whether the user can delete the applicant.
     *
     * @param  \App\User  $user
     * @param  \App\Applicant\Applicant  $applicant
     * @return mixed
     */
    public function delete(User $user, Applicant $applicant)
    {
        return $user->role == 'agency' && $user->link == $applicant->agency->id
            || $user->role == 'geziwen';
    }
}
