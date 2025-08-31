<?php

namespace App\Policies;

use App\Models\PriestlyFormation;
use App\Models\User;

class PriestlyFormationPolicy
{
    public function view(User $user, PriestlyFormation $formation): bool
    {
        return $user->id === $formation->user_id || $user->isAdmin();
    }

    public function update(User $user, PriestlyFormation $formation): bool
    {
        return $user->id === $formation->user_id || $user->isAdmin();
    }

    public function delete(User $user, PriestlyFormation $formation): bool
    {
        return $user->id === $formation->user_id || $user->isAdmin();
    }
}
