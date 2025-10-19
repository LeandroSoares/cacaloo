<?php

namespace App\Http\Controllers;

use App\Services\HomeContentService;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __construct(
        private readonly HomeContentService $homeContentService
    ) {}

    public function index(): View
    {
        $homeContent = $this->homeContentService->getHomeContent();

        return view('home', compact('homeContent'));
    }
}
