<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class Require2FAChallenge
{
    /**
     * Handle an incoming request.
     *
     * This middleware ensures that the 2FA challenge page can only be accessed
     * after successful username/password authentication. It prevents users from
     * bypassing the first authentication layer by accessing the challenge page directly.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Debug: log session details to troubleshoot session persistence across requests
        Log::debug('Require2FAChallenge middleware - session state', [
            'session_id' => session()->getId(),
            'admin_2fa_pending' => session('admin_2fa_pending'),
            'admin_2fa_passed' => session('admin_2fa_passed'),
            'cookie_header' => $request->headers->get('cookie'),
        ]);

        // Check if the admin has a pending 2FA challenge session OR is already authenticated
        // This flag is set by LoginController after successful password verification
        if (! session()->has('admin_2fa_pending') && ! \Illuminate\Support\Facades\Auth::check()) {
            // No pending 2FA session and not authenticated - log and redirect to login
            Log::warning('Require2FAChallenge: no pending 2FA session and not authenticated, redirecting to login', [
                'session_id' => session()->getId(),
                'cookie_header' => $request->headers->get('cookie'),
            ]);

            return redirect()->route('admin.login')
                ->withErrors(['error' => __('app.please_login_first')]);
        }

        return $next($request);
    }
}
