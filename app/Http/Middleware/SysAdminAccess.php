<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SysAdminAccess
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check() || !Auth::user()->hasRole('sysadmin')) {
            return redirect()->route('admin.dashboard')->with('error', 'Acesso não autorizado à área de sistema.');
        }

        return $next($request);
    }
}
