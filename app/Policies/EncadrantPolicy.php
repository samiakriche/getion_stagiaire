<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Encadrant;
use Illuminate\Auth\Access\HandlesAuthorization;

class EncadrantPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the encadrant.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Encadrant  $encadrant
     * @return mixed
     */
    public function view(User $user, Encadrant $encadrant)
    {
        // Update $user authorization to view $encadrant here.
        return true;
    }

    /**
     * Determine whether the user can create encadrant.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Encadrant  $encadrant
     * @return mixed
     */
    public function create(User $user, Encadrant $encadrant)
    {
        // Update $user authorization to create $encadrant here.
        return true;
    }

    /**
     * Determine whether the user can update the encadrant.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Encadrant  $encadrant
     * @return mixed
     */
    public function update(User $user, Encadrant $encadrant)
    {
        // Update $user authorization to update $encadrant here.
        return true;
    }

    /**
     * Determine whether the user can delete the encadrant.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Encadrant  $encadrant
     * @return mixed
     */
    public function delete(User $user, Encadrant $encadrant)
    {
        // Update $user authorization to delete $encadrant here.
        return true;
    }
}
