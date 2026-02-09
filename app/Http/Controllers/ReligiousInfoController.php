<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReligiousInfoRequest;
use App\Http\Resources\ReligiousInfoResource;
use App\Models\ReligiousInfo;
use App\Services\ReligiousInfoService;
use Illuminate\Support\Facades\Auth;

class ReligiousInfoController extends Controller
{
    public function show()
    {
        $religiousInfo = ReligiousInfo::where('user_id', Auth::id())->firstOrFail();
        $this->authorize('view', $religiousInfo);

        return new ReligiousInfoResource($religiousInfo);
    }

    public function store(ReligiousInfoRequest $request, ReligiousInfoService $service)
    {
        $religiousInfo = $service->store($request);

        return new ReligiousInfoResource($religiousInfo);
    }

    public function update(ReligiousInfoRequest $request, ReligiousInfoService $service)
    {
        $religiousInfo = ReligiousInfo::where('user_id', Auth::id())->firstOrFail();
        $this->authorize('update', $religiousInfo);
        $religiousInfo = $service->update($religiousInfo, $request);

        return new ReligiousInfoResource($religiousInfo);
    }
}
