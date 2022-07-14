<?php

namespace App\Policies;

use App\Models\Users\User;

class ManufacturerPolicy
{
    /**
     * @param User $user
     * @return bool
     */
    public function delete(User $user): bool
    {
        return $user->roles->contains(1);
    }
}
