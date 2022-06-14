<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserProfilePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the user_profile.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\UserProfile  $userProfile
     * @return mixed
     */
    public function view(User $user, UserProfile $userProfile)
    {
        // Update $user authorization to view $userProfile here.
        return true;
    }

    /**
     * Determine whether the user can create user_profile.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\UserProfile  $userProfile
     * @return mixed
     */
    public function create(User $user, UserProfile $userProfile)
    {
        // Update $user authorization to create $userProfile here.
        return true;
    }

    /**
     * Determine whether the user can update the user_profile.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\UserProfile  $userProfile
     * @return mixed
     */
    public function update(User $user, UserProfile $userProfile)
    {
        // Update $user authorization to update $userProfile here.
        return true;
    }

    /**
     * Determine whether the user can delete the user_profile.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\UserProfile  $userProfile
     * @return mixed
     */
    public function delete(User $user, UserProfile $userProfile)
    {
        // Update $user authorization to delete $userProfile here.
        return true;
    }
}
