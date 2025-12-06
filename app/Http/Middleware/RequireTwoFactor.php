<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RequireTwoFactor
{
    /**
     * Require 2FA for admin users if they have it enabled.
     */
    public function handle(Request $request, Closure $next, ?string $mode = null): Response
    {
        if (! Auth::check()) {
            return $next($request);
        }

        $user = Auth::user();

        // Only apply to admins
        if (!$user->isAdmin()) {
            return $next($request);
        }

        $adminProfile = $user->profile;

        // If the admin has 2FA enabled, ensure they have passed a recent challenge
        if ($adminProfile && $adminProfile->two_factor_enabled) {
            if (! session('admin_2fa_passed', false)) {
                // Allow 2FA setup/verify endpoints to be reachable without the flag
                $path = $request->path();
                if (str_contains($path, trim(config('admin.prefix', 'control-panel'), '/').'/2fa')) {
                    return $next($request);
                }

                // Log for debugging session persistence
                Log::debug('RequireTwoFactor: redirecting to 2fa.challenge', [
                    'session_id' => session()->getId(),
                    'admin_id' => $adminProfile->id_administrateur ?? null,
                    'cookie_header' => $request->headers->get('cookie'),
                ]);

                // Ensure the pending flag is set so Require2FAChallenge allows access
                session(['admin_2fa_pending' => true]);

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
        if ($adminProfile && ! $adminProfile->two_factor_enabled) {
            if ($user->role === 'super_admin') {
                // Ask super_admin to setup 2FA first
                Log::warning('RequireTwoFactor: super_admin without 2FA, redirecting to setup', [
                    'session_id' => session()->getId(),
                    'admin_id' => $adminProfile->id_administrateur ?? null,
                    'cookie_header' => $request->headers->get('cookie'),
                ]);

                return redirect()->route('admin.2fa.setup')->with('warning', __('app.2fa_required_setup'));
            }

            // Non-super_admins cannot proceed if 2FA is required but they don't have it
            Log::warning('RequireTwoFactor: non-super admin blocked due to missing 2FA', [
                'session_id' => session()->getId(),
                'admin_id' => $adminProfile->id_administrateur ?? null,
                'cookie_header' => $request->headers->get('cookie'),
            ]);

            abort(403, __('app.2fa_required_contact_admin'));
        }

        return $next($request);
    }
}
