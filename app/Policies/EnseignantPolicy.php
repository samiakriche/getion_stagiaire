<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Enseignant;
use Illuminate\Auth\Access\HandlesAuthorization;

class EnseignantPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the enseignant.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Enseignant  $enseignant
     * @return mixed
     */
    public function view(User $user, Enseignant $enseignant)
    {
        // Update $user authorization to view $enseignant here.
        return true;
    }

    /**
     * Determine whether the user can create enseignant.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Enseignant  $enseignant
     * @return mixed
     */
    public function create(User $user, Enseignant $enseignant)
    {
        // Update $user authorization to create $enseignant here.
        return true;
    }

    /**
     * Determine whether the user can update the enseignant.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Enseignant  $enseignant
     * @return mixed
     */
    public function update(User $user, Enseignant $enseignant)
    {
        // Update $user authorization to update $enseignant here.
        return true;
    }

    /**
     * Determine whether the user can delete the enseignant.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Enseignant  $enseignant
     * @return mixed
     */
    public function delete(User $user, Enseignant $enseignant)
    {
        // Update $user authorization to delete $enseignant here.
        return true;
    }
}
