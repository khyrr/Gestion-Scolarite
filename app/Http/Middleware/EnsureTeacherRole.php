<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureTeacherRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();
        
        if (!$user || (!$user->hasRole('teacher') && !$user->hasRole('enseignant'))) {
            abort(403, 'Access denied. Teacher access required.');
        }

        return $next($request);
    }
}