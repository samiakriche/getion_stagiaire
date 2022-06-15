<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Etudiant;
use Illuminate\Auth\Access\HandlesAuthorization;

class EtudiantPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the etudiant.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Etudiant  $etudiant
     * @return mixed
     */
    public function view(User $user, Etudiant $etudiant)
    {
        // Update $user authorization to view $etudiant here.
        return true;
    }

    /**
     * Determine whether the user can create etudiant.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Etudiant  $etudiant
     * @return mixed
     */
    public function create(User $user, Etudiant $etudiant)
    {
        // Update $user authorization to create $etudiant here.
        return true;
    }

    /**
     * Determine whether the user can update the etudiant.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Etudiant  $etudiant
     * @return mixed
     */
    public function update(User $user, Etudiant $etudiant)
    {
        // Update $user authorization to update $etudiant here.
        return true;
    }

    /**
     * Determine whether the user can delete the etudiant.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Etudiant  $etudiant
     * @return mixed
     */
    public function delete(User $user, Etudiant $etudiant)
    {
        // Update $user authorization to delete $etudiant here.
        return true;
    }
}
