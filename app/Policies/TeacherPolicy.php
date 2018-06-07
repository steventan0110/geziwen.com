<?php

namespace App\Policies;

use App\User;
use App\Agency\Teacher;
use Illuminate\Auth\Access\HandlesAuthorization;

class TeacherPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the teacher.
     *
     * @param  \App\User  $user
     * @param  \App\Teacher  $teacher
     * @return mixed
     */
    public function view(User $user, Teacher $teacher)
    {
        return true;
    }

    /**
     * Determine whether the user can create teachers.
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
     * Determine whether the user can update the teacher.
     *
     * @param  \App\User  $user
     * @param  \App\Teacher  $teacher
     * @return mixed
     */
    public function update(User $user, Teacher $teacher)
    {
        if ($user->role == 'agency') {
            return $user->link == $teacher->agency->id;
        } else if ($user->role == 'geziwen') {
            return $teacher->agency->manager->id == $user->id;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the teacher.
     *
     * @param  \App\User  $user
     * @param  \App\Teacher  $teacher
     * @return mixed
     */
    public function delete(User $user, Teacher $teacher)
    {
        if ($user->role == 'agency') {
            return $user->link == $teacher->agency->id;
        } else if ($user->role == 'geziwen') {
            return $teacher->agency->manager->id == $user->id;
        }
        return false;
    }
}
