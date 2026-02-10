<?php

namespace App\Policies;

use App\Models\ForceCross;
use App\Models\User;

class ForceCrossPolicy
{
    public function view(User $user, ForceCross $forceCross): bool
    {
        return $user->id === $forceCross->user_id;
    }

    public function update(User $user, ForceCross $forceCross): bool
    {
        return $user->id === $forceCross->user_id;
    }

    public function delete(User $user, ForceCross $forceCross): bool
    {
        return $user->id === $forceCross->user_id;
    }
}
