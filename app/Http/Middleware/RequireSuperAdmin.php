<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\ActivityLog;

class RequireSuperAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if (! $user || ($user->role ?? '') !== 'super_admin') {
            Log::warning('Access denied: Non-super_admin attempted to access super_admin route', [
                'user_id' => $user->id ?? 'guest',
                'user_role' => $user->role ?? 'none',
                'url' => $request->fullUrl(),
                'ip' => $request->ip(),
            ]);

            if ($user) {
                ActivityLog::create([
                    'user_type' => get_class($user),
                    'user_id' => $user->id,
                    'action' => 'access_denied_super_admin',
                    'resource' => $request->path(),
                    'description' => "Unauthorized access to super admin route. User role: " . ($user->role ?? 'none'),
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                ]);
            }

            abort(403, 'Only super administrators are allowed to perform this action.');
        }

        return $next($request);
    }
}
