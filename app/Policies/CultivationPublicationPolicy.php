<?php

namespace App\Policies;

use App\Models\CultivationPublication;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CultivationPublicationPolicy
{
    use HandlesAuthorization;

    public function update(User $user, CultivationPublication $cultivationPublication)
    {
        return $user->id === $cultivationPublication->id_user;
    }

    public function delete(User $user, CultivationPublication $cultivationPublication)
    {
        return $user->id === $cultivationPublication->id_user;
    }
}