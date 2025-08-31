<?php

namespace App\Http\Controllers;

use App\Http\Requests\PersonalDataRequest;
use App\Http\Resources\PersonalDataResource;
use App\Models\PersonalData;
use App\Services\PersonalDataService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PersonalDataController extends Controller
{
    public function show()
    {
        $personalData = PersonalData::where('user_id', Auth::id())->firstOrFail();
        $this->authorize('view', $personalData);
        return new PersonalDataResource($personalData);
    }

    public function store(PersonalDataRequest $request, PersonalDataService $service)
    {
        $personalData = $service->store($request);
        return new PersonalDataResource($personalData);
    }

    public function update(PersonalDataRequest $request, PersonalDataService $service)
    {
        $personalData = PersonalData::where('user_id', Auth::id())->firstOrFail();
        $this->authorize('update', $personalData);
        $personalData = $service->update($personalData, $request);
        return new PersonalDataResource($personalData);
    }
}
