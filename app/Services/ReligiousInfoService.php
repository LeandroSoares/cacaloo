<?php

namespace App\Services;

use App\Http\Requests\ReligiousInfoRequest;
use App\Models\ReligiousInfo;
use Illuminate\Support\Facades\Auth;

class ReligiousInfoService
{
    public function store(ReligiousInfoRequest $request): ReligiousInfo
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();

        return ReligiousInfo::create($data);
    }

    public function update(ReligiousInfo $religiousInfo, ReligiousInfoRequest $request): ReligiousInfo
    {
        $religiousInfo->update($request->validated());

        return $religiousInfo;
    }

    public function delete(ReligiousInfo $religiousInfo): void
    {
        $religiousInfo->delete();
    }
}
