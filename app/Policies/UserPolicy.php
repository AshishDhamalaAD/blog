<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function update(User $authUser, User $user)
    {
        return $user->isAdmin() && $authUser->id !== $user->id;
    }

    public function delete(User $authUser, User $user)
    {
        return $user->isAdmin() && $authUser->id !== $user->id;
    }
}
