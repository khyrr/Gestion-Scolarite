<?php

namespace App\Http\Middleware\Legacy;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\ActivityLogger;

class RequireSuperAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if (! $user || ! $user->hasRole('super_admin')) {
            $roleName = $user ? ($user->getRoleNames()->first() ?? 'none') : 'none';
            
            Log::warning('Access denied: Non-super_admin attempted to access super_admin route', [
                'user_id' => $user->id ?? 'guest',
                'user_role' => $roleName,
                'url' => $request->fullUrl(),
                'ip' => $request->ip(),
            ]);

            if ($user) {
                ActivityLogger::log(
                    get_class($user),
                    $user->id,
                    'access_denied_super_admin',
                    $request->path(),
                    null,
                    "Unauthorized access to super admin route. User role: " . $roleName,
                    null,
                    $request
                );
            }

            abort(403, 'Only super administrators are allowed to perform this action.');
        }

        return $next($request);
    }
}
