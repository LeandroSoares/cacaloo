<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAccess
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check() || !Auth::user()->hasRole(['admin', 'sysadmin'])) {
            return redirect()->route('dashboard')->with('error', 'Acesso não autorizado à área administrativa.');
        }

        return $next($request);
    }
}
