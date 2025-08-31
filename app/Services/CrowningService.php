<?php

namespace App\Services;

use App\Models\Crowning;
use Illuminate\Support\Facades\Auth;

class CrowningService
{
    public function store(array $data): Crowning
    {
        $data['user_id'] = Auth::id();
        return Crowning::create($data);
    }
}
