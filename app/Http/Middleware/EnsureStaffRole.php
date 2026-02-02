<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureStaffRole
{
    /**
     * Handle an incoming request.
     * Allows access for operational staff roles.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();
        
        if (!$user || !$user->hasAnyRole(['secretary', 'accountant'])) {
            abort(403, 'Access denied. Staff access required.');
        }

        return $next($request);
    }
}