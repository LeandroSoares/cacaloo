<?php

namespace App\Policies;

use App\Models\ReligiousInfo;
use App\Models\User;

class ReligiousInfoPolicy
{
    public function view(User $user, ReligiousInfo $religiousInfo): bool
    {
        return $user->id === $religiousInfo->user_id || $user->isAdmin();
    }

    public function update(User $user, ReligiousInfo $religiousInfo): bool
    {
        return $user->id === $religiousInfo->user_id || $user->isAdmin();
    }

    public function delete(User $user, ReligiousInfo $religiousInfo): bool
    {
        return $user->id === $religiousInfo->user_id || $user->isAdmin();
    }
}
