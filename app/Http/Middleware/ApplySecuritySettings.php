<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApplySecuritySettings
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Force HTTPS if setting is enabled
        if (setting('force_https', false) && !$request->secure() && app()->environment('production')) {
            return redirect()->secure($request->getRequestUri());
        }

        // Apply session timeout
        $sessionTimeout = setting('session_timeout', 120); // minutes
        config(['session.lifetime' => $sessionTimeout]);

        return $next($request);
    }
}