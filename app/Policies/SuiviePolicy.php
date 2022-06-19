<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Suivie;
use Illuminate\Auth\Access\HandlesAuthorization;

class SuiviePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the suivie.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Suivie  $suivie
     * @return mixed
     */
    public function view(User $user, Suivie $suivie)
    {
        // Update $user authorization to view $suivie here.
        return true;
    }

    /**
     * Determine whether the user can create suivie.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Suivie  $suivie
     * @return mixed
     */
    public function create(User $user, Suivie $suivie)
    {
        // Update $user authorization to create $suivie here.
        return true;
    }

    /**
     * Determine whether the user can update the suivie.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Suivie  $suivie
     * @return mixed
     */
    public function update(User $user, Suivie $suivie)
    {
        // Update $user authorization to update $suivie here.
        return true;
    }

    /**
     * Determine whether the user can delete the suivie.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Suivie  $suivie
     * @return mixed
     */
    public function delete(User $user, Suivie $suivie)
    {
        // Update $user authorization to delete $suivie here.
        return true;
    }
}
