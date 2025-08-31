<?php

namespace App\Policies;

use App\Models\PersonalData;
use App\Models\User;

class PersonalDataPolicy
{
    public function view(User $user, PersonalData $personalData): bool
    {
        return $user->id === $personalData->user_id || $user->isAdmin();
    }

    public function update(User $user, PersonalData $personalData): bool
    {
        return $user->id === $personalData->user_id || $user->isAdmin();
    }

    public function delete(User $user, PersonalData $personalData): bool
    {
        return $user->id === $personalData->user_id || $user->isAdmin();
    }
}
