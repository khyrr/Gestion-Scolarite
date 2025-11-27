<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RequireSuperAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $admin = auth('admin')->user();

        if (! $admin || ($admin->role ?? '') !== 'super_admin') {
            abort(403, 'Only super administrators are allowed to perform this action.');
        }

        return $next($request);
    }
}
