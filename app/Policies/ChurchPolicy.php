<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Church;
use Illuminate\Auth\Access\HandlesAuthorization;

class ChurchPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the church.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Church  $church
     * @return mixed
     */
    public function view(User $user, Church $church)
    {
        return true;
    }

    /**
     * Determine whether the user can create churches.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isSuperAdmin;
    }

    /**
     * Determine whether the user can update the church.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Church  $church
     * @return mixed
     */
    public function update(User $user, Church $church)
    {
        return $user->isSuperAdmin;
    }

    /**
     * Determine whether the user can delete the church.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Church  $church
     * @return mixed
     */
    public function delete(User $user, Church $church)
    {
        return $user->isSuperAdmin;
    }
}
