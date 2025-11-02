<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\DailyMessage;

class DashboardController extends Controller
{
    /**
     * Display the user dashboard.
     */
    public function index()
    {
        // Busca a mensagem do dia
        $dailyMessage = DailyMessage::getTodaysMessage();

        return view('user.dashboard', compact('dailyMessage'));
    }
}
