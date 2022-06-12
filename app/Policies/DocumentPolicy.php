<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Document;
use Illuminate\Auth\Access\HandlesAuthorization;

class DocumentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the document.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Document  $document
     * @return mixed
     */
    public function view(User $user, Document $document)
    {
        // Update $user authorization to view $document here.
        return true;
    }

    /**
     * Determine whether the user can create document.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Document  $document
     * @return mixed
     */
    public function create(User $user, Document $document)
    {
        // Update $user authorization to create $document here.
        return true;
    }

    /**
     * Determine whether the user can update the document.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Document  $document
     * @return mixed
     */
    public function update(User $user, Document $document)
    {
        // Update $user authorization to update $document here.
        return true;
    }

    /**
     * Determine whether the user can delete the document.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Document  $document
     * @return mixed
     */
    public function delete(User $user, Document $document)
    {
        // Update $user authorization to delete $document here.
        return true;
    }
}
