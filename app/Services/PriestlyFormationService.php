<?php

namespace App\Services;

use App\Models\PriestlyFormation;
use App\Http\Requests\PriestlyFormationRequest;
use Illuminate\Support\Facades\Auth;

class PriestlyFormationService
{
    public function store(PriestlyFormationRequest $request): PriestlyFormation
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();
        return PriestlyFormation::create($data);
    }

    public function update(PriestlyFormation $formation, PriestlyFormationRequest $request): PriestlyFormation
    {
        $formation->update($request->validated());
        return $formation;
    }

    public function delete(PriestlyFormation $formation): void
    {
        $formation->delete();
    }
}
