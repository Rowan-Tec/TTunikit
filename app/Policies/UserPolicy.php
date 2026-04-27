<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Determine if the user can view the users list
     */
    public function viewUsers(User $user): bool
    {
        return in_array($user->role, ['admin', 'super_admin']);
    }

    /**
     * Determine if the user can edit another user
     */
    public function editUser(User $user, User $target): bool
    {
        // Only admin and super_admin can edit users
        if (!in_array($user->role, ['admin', 'super_admin'])) {
            return false;
        }

        // Users cannot edit themselves
        if ($user->id === $target->id) {
            return false;
        }

        return true;
    }
}
