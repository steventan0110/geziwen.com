<?php

namespace App\Policies;

use App\User;
use App\comment;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the comment.
     *
     * @param  \App\User  $user
     * @param  \App\comment  $comment
     * @return mixed
     */
    public function view(User $user, comment $comment)
    {
        return true;
    }

    /**
     * Determine whether the user can create comments.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->role != 'agency' ;
    }

    /**
     * Determine whether the user can update the comment.
     *
     * @param  \App\User  $user
     * @param  \App\comment  $comment
     * @return mixed
     */
    public function update(User $user, comment $comment)
    {
        //
    }

    /**
     * Determine whether the user can delete the comment.
     *
     * @param  \App\User  $user
     * @param  \App\comment  $comment
     * @return mixed
     */
    public function delete(User $user, comment $comment)
    {
        //
    }
}
