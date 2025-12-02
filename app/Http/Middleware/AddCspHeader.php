<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AddCspHeader
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        die('Middleware running');

        // Permissive CSP to allow Livewire/Alpine.js (unsafe-eval)
        // and external resources (Cloudflare, fonts, etc.)
        $response->headers->set(
            'Content-Security-Policy',
            "default-src * data: blob: 'unsafe-inline' 'unsafe-eval'; script-src * 'unsafe-inline' 'unsafe-eval'; connect-src * 'unsafe-inline'; img-src * data: blob: 'unsafe-inline'; frame-src *; style-src * 'unsafe-inline';"
        );
        $response->headers->set('X-CSP-Debug', 'true');

        return $response;
    }
}
