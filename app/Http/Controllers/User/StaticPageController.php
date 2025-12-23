<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Orisha;

class StaticPageController extends Controller
{
    public function orixas()
    {
        $orishas = Orisha::where('active', true)->orderBy('name')->get();
        return view('user.static-pages.orixas', compact('orishas'));
    }
}
