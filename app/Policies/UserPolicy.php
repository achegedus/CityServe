<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the user.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewlist(User $user)
    {
//        return $user->isSuperAdmin();
        return true;
    }

    /**
     * Determine whether the user can view the user.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $view_user
     * @return mixed
     */
    public function view(User $user, User $view_user)
    {
//        return $user->isSuperAdmin();
        return true;
    }

    /**
     * Determine whether the user can create users.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
        return $user->isSuperAdmin();
    }

    /**
     * Determine whether the user can update the user.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $update_user
     * @return mixed
     */
    public function update(User $user, User $update_user)
    {
        //
        return $user->isSuperAdmin();
    }

    /**
     * Determine whether the user can delete the user.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $delete_user
     * @return mixed
     */
    public function delete(User $user, User $delete_user)
    {
        //
        return $user->isSuperAdmin();
    }
}
