<?php

namespace App\Services;

use App\Models\EntityConsecration;
use Illuminate\Support\Facades\Auth;

class EntityConsecrationService
{
    public function store(array $data): EntityConsecration
    {
        $data['user_id'] = Auth::id();
        return EntityConsecration::updateOrCreate(
            ['user_id' => Auth::id()],
            $data
        );
    }
}
