<?php

namespace App\Http\Middleware;

use App\Services\TwoFactorService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureTwoFactorIsVerified
{
    public function __construct(
        protected TwoFactorService $twoFactorService
    ) {}

    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user) {
            return $next($request);
        }

        // Skip for 2FA pages and logout
        if ($this->isExemptRoute($request)) {
            return $next($request);
        }

        // If 2FA is required by config and user hasn't confirmed it yet
        if (config('security.require_2fa', false)) {
            if (!$this->twoFactorService->isConfirmed($user)) {

                return redirect()->route('filament.admin.pages.two-factor-setup');
            }
        }

        // If 2FA is enabled and confirmed, check if needs reconfirmation
        if ($this->twoFactorService->isConfirmed($user)) {
            if (!$this->twoFactorService->isRecentlyVerified($user)) {
                session(['2fa_intended_url' => $request->url()]);

                return redirect()->route('filament.admin.pages.two-factor-challenge');
            }
        }

        return $next($request);
    }

    /**
     * Check if the route is exempt from 2FA verification.
     */
    protected function isExemptRoute(Request $request): bool
    {
        $exemptRoutes = [
            'filament.admin.pages.two-factor-setup',
            'filament.admin.pages.two-factor-challenge',
            'filament.admin.pages.two-factor-recovery-codes',
            'filament.admin.auth.logout',
            'logout',
        ];

        // If the named route exists and is in the exempt list, skip
        if (in_array($request->route()?->getName(), $exemptRoutes)) {
            return true;
        }

        // Also allow direct path matches for the admin 2FA endpoints (avoids reliance on named routes)
        if (str_starts_with($request->path(), 'filament.admin.pages.two-factor-setup')) {
            return true;
        }

        return false;
    }
}
