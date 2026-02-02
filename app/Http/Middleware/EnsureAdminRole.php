<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdminRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();
        
        if (!$user || !$user->hasAnyRole(['super_admin', 'director', 'academic_coordinator', 'secretary', 'accountant'])) {
            abort(403, 'Access denied. Administrator access required.');
        }

        return $next($request);
    }
}