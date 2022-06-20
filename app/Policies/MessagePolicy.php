<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Message;
use Illuminate\Auth\Access\HandlesAuthorization;

class MessagePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the message.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Message  $message
     * @return mixed
     */
    public function view(User $user, Message $message)
    {
        // Update $user authorization to view $message here.
        return true;
    }

    /**
     * Determine whether the user can create message.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Message  $message
     * @return mixed
     */
    public function create(User $user, Message $message)
    {
        // Update $user authorization to create $message here.
        return true;
    }

    /**
     * Determine whether the user can update the message.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Message  $message
     * @return mixed
     */
    public function update(User $user, Message $message)
    {
        // Update $user authorization to update $message here.
        return true;
    }

    /**
     * Determine whether the user can delete the message.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Message  $message
     * @return mixed
     */
    public function delete(User $user, Message $message)
    {
        // Update $user authorization to delete $message here.
        return true;
    }
}
