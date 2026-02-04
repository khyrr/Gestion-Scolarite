<?php

namespace App\Services;

use App\Models\User;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\Writer\SvgWriter;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\RateLimiter;
use Laravel\Fortify\RecoveryCode;
use PragmaRX\Google2FA\Google2FA;

class TwoFactorService
{
    protected Google2FA $google2fa;

    public function __construct()
    {
        $this->google2fa = new Google2FA();
    }

    public function enable(User $user): void
    {
        $user->forceFill([
            'two_factor_secret' => encrypt($this->google2fa->generateSecretKey()),
            'two_factor_recovery_codes' => encrypt(json_encode($this->generateRecoveryCodes())),
            'two_factor_confirmed_at' => null,
        ])->save();
    }

    public function confirm(User $user, string $code): bool
    {
        if (! $this->verify($user, $code)) {
            return false;
        }

        $user->forceFill([
            'two_factor_confirmed_at' => now(),
        ])->save();

        // Session flag: verified now
        $this->markAsVerified($user);
        $this->clearFailedAttempts($user);

        return true;
    }

    public function disable(User $user): void
    {
        $user->forceFill([
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'two_factor_confirmed_at' => null,
        ])->save();

        $this->clearVerificationStatus();
        $this->clearFailedAttempts($user);
    }

    public function isEnabled(User $user): bool
    {
        return filled($user->two_factor_secret);
    }

    public function isConfirmed(User $user): bool
    {
        return filled($user->two_factor_confirmed_at);
    }

    /**
     * Verify TOTP code.
     */
    public function verify(User $user, string $code): bool
    {
        if (! $this->isEnabled($user)) {
            return false;
        }

        $secretEncrypted = $user->two_factor_secret;

        if (blank($secretEncrypted)) {
            return false;
        }

        $secret = decrypt($secretEncrypted);

        // window = 2 => tolerance time drift
        return $this->google2fa->verifyKey($secret, $this->normalizeCode($code), 2);
    }

    /**
     * Verify a recovery code (constant-time + remove after use).
     */
    public function verifyRecoveryCode(User $user, string $code): bool
    {
        $codes = $this->getRecoveryCodes($user);
        if (empty($codes)) {
            return false;
        }

        $code = $this->normalizeCode($code);

        $matchIndex = null;
        foreach ($codes as $i => $stored) {
            if (is_string($stored) && hash_equals($stored, $code)) {
                $matchIndex = $i;
                break;
            }
        }

        if ($matchIndex === null) {
            return false;
        }

        // remove used recovery code
        unset($codes[$matchIndex]);
        $codes = array_values($codes);

        $user->forceFill([
            'two_factor_recovery_codes' => encrypt(json_encode($codes)),
        ])->save();

        return true;
    }

    public function regenerateRecoveryCodes(User $user): array
    {
        $codes = $this->generateRecoveryCodes();

        $user->forceFill([
            'two_factor_recovery_codes' => encrypt(json_encode($codes)),
        ])->save();

        return $codes;
    }

    /**
     * Generate QR code for 2FA setup.
     */
    public function qrCodeInline(User $user): string
    {
        if (! $this->isEnabled($user)) {
            $this->enable($user);
            $user->refresh();
        }

        $secret = decrypt($user->two_factor_secret);

        $qrCodeUrl = $this->google2fa->getQRCodeUrl(
            config('app.name'),
            $user->email,
            $secret
        );

        $result = Builder::create()
            ->writer(new SvgWriter())
            ->data($qrCodeUrl)
            ->encoding(new Encoding('UTF-8'))
            ->size(200)
            ->margin(10)
            ->build();

        return $result->getString();
    }

    /**
     * Only show secret during setup.
     */
    public function getSecretKeyForSetup(User $user): ?string
    {
        if (! $this->isEnabled($user)) {
            return null;
        }

        // optional: only allow if not confirmed
        if ($this->isConfirmed($user)) {
            return null;
        }

        return decrypt($user->two_factor_secret);
    }

    public function getRecoveryCodes(User $user): array
    {
        if (blank($user->two_factor_recovery_codes)) {
            return [];
        }

        $decoded = json_decode(decrypt($user->two_factor_recovery_codes), true);

        return is_array($decoded) ? $decoded : [];
    }

    // ----------------------------
    // Session verified flag
    // ----------------------------

    public function markAsVerified(User $user): void
    {
        // prevent session fixation
        request()->session()->regenerate();

        session([
            'filament_2fa_verified_at' => now()->timestamp,
            'filament_2fa_user_id' => $user->id,
        ]);
    }

    public function isRecentlyVerified(User $user): bool
    {
        $verifiedAt = session('filament_2fa_verified_at');
        $userId = session('filament_2fa_user_id');

        if (! $verifiedAt || $userId !== $user->id) {
            return false;
        }

        $reconfirmMinutes = (int) config('security.reconfirm_minutes', 30);

        // If 0 => always ask challenge
        if ($reconfirmMinutes <= 0) {
            return false;
        }

        return now()->timestamp - $verifiedAt < ($reconfirmMinutes * 60);
    }

    public function clearVerificationStatus(): void
    {
        session()->forget(['filament_2fa_verified_at', 'filament_2fa_user_id']);
    }

    // ----------------------------
    // Rate limiting (Laravel native)
    // ----------------------------

    public function ensureNotRateLimited(User $user): void
    {
        $key = $this->rateLimitKey($user);
        $maxAttempts = (int) setting('security.max_login_attempts', 5);
        $lockoutDuration = (int) setting('security.lockout_duration', 15); // minutes
        $decaySeconds = $lockoutDuration * 60; // Convert minutes to seconds

        if (RateLimiter::tooManyAttempts($key, $maxAttempts)) {
            abort(429, 'Too many 2FA attempts. Please try again later.');
        }

        // hit is done when verification fails
        // RateLimiter::hit($key, $decaySeconds);
    }

    public function incrementFailedAttempts(User $user): void
    {
        $key = $this->rateLimitKey($user);
        $lockoutDuration = (int) setting('security.lockout_duration', 15); // minutes
        $decaySeconds = $lockoutDuration * 60; // Convert minutes to seconds

        RateLimiter::hit($key, $decaySeconds);
    }

    public function clearFailedAttempts(User $user): void
    {
        RateLimiter::clear($this->rateLimitKey($user));
    }

    protected function rateLimitKey(User $user): string
    {
        return '2fa:attempts:user:' . $user->id;
    }

    // ----------------------------
    // Helpers
    // ----------------------------

    protected function generateRecoveryCodes(): array
    {
        $count = (int) config('security.recovery_codes_count', 8);

        return Collection::times($count, fn () => RecoveryCode::generate())->all();
    }

    protected function normalizeCode(string $code): string
    {
        return preg_replace('/\s+/', '', trim($code)) ?? '';
    }
}
