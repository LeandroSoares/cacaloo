<?php

namespace App\Policies;

use App\Models\User;
use App\Models\HeadOrisha;

class HeadOrishaPolicy
{
    public function view(User $user, HeadOrisha $headOrisha): bool
    {
        return $user->id === $headOrisha->user_id;
    }

    public function update(User $user, HeadOrisha $headOrisha): bool
    {
        return $user->id === $headOrisha->user_id;
    }

    public function delete(User $user, HeadOrisha $headOrisha): bool
    {
        return $user->id === $headOrisha->user_id;
    }
}
