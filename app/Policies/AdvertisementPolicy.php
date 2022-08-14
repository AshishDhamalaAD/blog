<?php

namespace App\Policies;

use App\Models\Advertisement;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdvertisementPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Advertisement $advertisement)
    {
        
    }

    public function delete(User $user, Advertisement $advertisement)
    {
        
    }
}
