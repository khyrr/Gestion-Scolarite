<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RequireTwoFactor
{
    /**
     * Require 2FA for admin users if they have it enabled.
     */
    public function handle(Request $request, Closure $next, ?string $mode = null): Response
    {
        if (! Auth::guard('admin')->check()) {
            return $next($request);
        }

        $admin = Auth::guard('admin')->user();

        // If the admin has 2FA enabled, ensure they have passed a recent challenge
        if ($admin && $admin->two_factor_enabled) {
            if (! session('admin_2fa_passed', false)) {
                // Allow 2FA setup/verify endpoints to be reachable without the flag
                $path = $request->path();
                if (str_contains($path, trim(config('admin.prefix', 'control-panel'), '/').'/2fa')) {
                    return $next($request);
                }

                return redirect()->route('admin.2fa.challenge');
            }

            return $next($request);
        }

        // If mode is 'if_enabled' we only enforce when 2FA is enabled for this admin
        // else if no 2FA enabled, we allow passing through.
        if ($mode === 'if_enabled') {
            return $next($request);
        }

        // Admin does NOT have 2FA enabled but we are on a route protected by require.2fa (strict mode)
        // Policy: super_admins are prompted to setup 2FA before proceeding; regular admins are denied.
        if ($admin && ! $admin->two_factor_enabled) {
            if ($admin->role === 'super_admin') {
                // Ask super_admin to setup 2FA first
                return redirect()->route('admin.2fa.setup')->with('warning', __('app.2fa_required_setup'));
            }

            // Non-super_admins cannot proceed if 2FA is required but they don't have it
            abort(403, __('app.2fa_required_contact_admin'));
        }

        return $next($request);
    }
}
