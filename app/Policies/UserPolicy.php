<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function update(User $authUser, User $user)
    {
        if ($user->isAdmin()) {
            return false;
        }

        if ($authUser->is($user)) {
            return false;
        }
    }

    public function delete(User $authUser, User $user)
    {
        if ($user->isAdmin()) {
            return false;
        }

        if ($authUser->is($user)) {
            return false;
        }
    }
}
