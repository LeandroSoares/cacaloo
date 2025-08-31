<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ForceCross;

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
