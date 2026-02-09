<?php

namespace App\Http\Controllers;

use App\Http\Requests\PriestlyFormationRequest;
use App\Http\Resources\PriestlyFormationResource;
use App\Models\PriestlyFormation;
use App\Services\PriestlyFormationService;
use Illuminate\Support\Facades\Auth;

class PriestlyFormationController extends Controller
{
    public function show()
    {
        $formation = PriestlyFormation::where('user_id', Auth::id())->firstOrFail();
        $this->authorize('view', $formation);

        return new PriestlyFormationResource($formation);
    }

    public function store(PriestlyFormationRequest $request, PriestlyFormationService $service)
    {
        $formation = $service->store($request);

        return new PriestlyFormationResource($formation);
    }

    public function update(PriestlyFormationRequest $request, PriestlyFormationService $service)
    {
        $formation = PriestlyFormation::where('user_id', Auth::id())->firstOrFail();
        $this->authorize('update', $formation);
        $formation = $service->update($formation, $request);

        return new PriestlyFormationResource($formation);
    }
}
