<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\AdminAllowedIp;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class IpWhitelistMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!config('admin.security.ip_whitelist_enabled')) {
            return $next($request);
        }

        $ip = $request->ip();
        
        // If the table doesn't exist yet (fresh install / migrated state), skip whitelist
        // checks — treating missing table as 'disabled' prevents runtime exceptions
        // when the DB schema isn't fully created (e.g. during migrations/tests).
        if (! Schema::hasTable('admin_allowed_ips')) {
            Log::info('Admin IP whitelist table not present; skipping whitelist check');
            return $next($request);
        }

        // Check if IP is in allowed list (guarded in try/catch in case of DB race conditions)
        try {
            $isAllowed = AdminAllowedIp::where('ip_address', $ip)
                ->where('is_active', true)
                ->exists();
        } catch (\Throwable $e) {
            // If anything goes wrong querying the table (e.g. temporary DB error),
            // avoid blocking the request — better to allow admin access than raise 500.
            Log::warning('Error while checking admin_allowed_ips table: ' . $e->getMessage());
            return $next($request);
        }

        if (!$isAllowed) {
            // Log the attempt internally so admins can investigate attacks. When
            // returning 404 we'll still record the incident but we avoid leaking
            // the administrative endpoint's existence externally.
            Log::warning("Unauthorized admin access attempt from IP: {$ip}");

            $status = (int) config('admin.security.ip_whitelist_reject_status', 403);

            // For opaque responses (e.g. 404) avoid revealing 'not allowed' message
            // which could help attackers. Use abort($status) to render the proper
            // HTTP error page; when status is not 404 we include the descriptive message.
            if ($status === 404) {
                abort(404);
            }

            abort($status, 'Unauthorized access. Your IP address is not allowed.');
        }

        return $next($request);
    }
}
