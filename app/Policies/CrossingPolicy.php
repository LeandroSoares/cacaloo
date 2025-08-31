<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Crossing;

class CrossingPolicy
{
    public function view(User $user, Crossing $crossing): bool
    {
        return $user->id === $crossing->user_id;
    }

    public function update(User $user, Crossing $crossing): bool
    {
        return $user->id === $crossing->user_id;
    }

    public function delete(User $user, Crossing $crossing): bool
    {
        return $user->id === $crossing->user_id;
    }
}
