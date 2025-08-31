<?php

namespace App\Services;

use App\Models\PersonalData;
use App\Http\Requests\PersonalDataRequest;
use Illuminate\Support\Facades\Auth;

class PersonalDataService
{
    public function store(PersonalDataRequest $request): PersonalData
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();
        return PersonalData::create($data);
    }

    public function update(PersonalData $personalData, PersonalDataRequest $request): PersonalData
    {
        $personalData->update($request->validated());
        return $personalData;
    }

    public function delete(PersonalData $personalData): void
    {
        $personalData->delete();
    }
}
