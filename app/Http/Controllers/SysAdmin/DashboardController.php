<?php

namespace App\Http\Controllers\SysAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('sysadmin.dashboard');
    }

    public function logs(Request $request)
    {
        if ($request->has('download')) {
            $logPath = storage_path('logs/laravel.log');
            if (file_exists($logPath)) {
                return response()->download($logPath, 'laravel-log-'.date('Y-m-d').'.log');
            }

            return back()->with('error', 'Arquivo de log não encontrado.');
        }

        return view('sysadmin.system.logs');
    }
}
