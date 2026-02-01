<?php

namespace App\Services;

use App\Models\User;

class SecurityPolicyService
{
    /**
     * Check if 2FA is required for the application.
     */
    public function isTwoFactorRequired(): bool
    {
        return config('security.require_2fa', false);
    }

    /**
     * Check if user has 2FA properly configured.
     */
    public function hasTwoFactorEnabled(User $user): bool
    {
        return !is_null($user->two_factor_secret) 
            && !is_null($user->two_factor_confirmed_at);
    }

    /**
     * Check if user needs to enable 2FA.
     */
    public function needsToEnableTwoFactor(User $user): bool
    {
        return $this->isTwoFactorRequired() && !$this->hasTwoFactorEnabled($user);
    }

    /**
     * Check if user can access the application.
     */
    public function canAccessApplication(User $user): bool
    {
        if (!$this->isTwoFactorRequired()) {
            return true;
        }

        return $this->hasTwoFactorEnabled($user);
    }

    /**
     * Get the URL where user should be redirected if 2FA is required.
     */
    public function getTwoFactorSetupUrl(): string
    {
        return route('filament.admin.pages.two-factor-setup');
    }
}
