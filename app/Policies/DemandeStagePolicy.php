<?php

namespace App\Policies;

use App\Models\User;
use App\Models\DemandeStage;
use Illuminate\Auth\Access\HandlesAuthorization;

class DemandeStagePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the demande_stage.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\DemandeStage  $demandeStage
     * @return mixed
     */
    public function view(User $user, DemandeStage $demandeStage)
    {
        // Update $user authorization to view $demandeStage here.
        return true;
    }

    /**
     * Determine whether the user can create demande_stage.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\DemandeStage  $demandeStage
     * @return mixed
     */
    public function create(User $user, DemandeStage $demandeStage)
    {
        // Update $user authorization to create $demandeStage here.
        return true;
    }

    /**
     * Determine whether the user can update the demande_stage.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\DemandeStage  $demandeStage
     * @return mixed
     */
    public function update(User $user, DemandeStage $demandeStage)
    {
        // Update $user authorization to update $demandeStage here.
        return true;
    }

    /**
     * Determine whether the user can delete the demande_stage.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\DemandeStage  $demandeStage
     * @return mixed
     */
    public function delete(User $user, DemandeStage $demandeStage)
    {
        // Update $user authorization to delete $demandeStage here.
        return true;
    }
}
