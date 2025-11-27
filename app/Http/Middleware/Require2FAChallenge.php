<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

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
        // Check if the admin has a pending 2FA challenge session
        // This flag is set by AdminAuthController after successful password verification
        if (!session()->has('admin_2fa_pending')) {
            // No pending 2FA session - redirect to login
            return redirect()->route('admin.login')
                ->withErrors(['error' => __('app.please_login_first')]);
        }

        return $next($request);
    }
}
