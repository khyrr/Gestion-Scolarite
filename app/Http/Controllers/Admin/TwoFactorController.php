<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\TwoFactorService;
use App\Services\QrService;
use App\Services\ActivityLogger;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;

class TwoFactorController extends Controller
{
    // TTL for pending regeneration in seconds (10 minutes)
    private const PENDING_TTL = 600;

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Build a proper otpauth provisioning URI (URL-encode label/issuer).
     */
    private function buildProvisioningUri(string $issuer, string $account, string $secret): string
    {
        $label = rawurlencode($account);
        $encodedIssuer = rawurlencode($issuer);

        return "otpauth://totp/{$encodedIssuer}:{$label}?secret={$secret}&issuer={$encodedIssuer}&digits=" . TwoFactorService::DIGITS;
    }

    /** Show the setup page with a generated secret */
    public function showSetup(Request $request)
    {
        /** @var \App\Models\Administrateur $admin */
        $admin = Auth::guard('admin')->user();

        // Check pending regeneration and TTL from session
        $pendingRegeneration = session('admin_2fa_pending_regeneration');
        if ($pendingRegeneration) {
            $created = $pendingRegeneration['created_at'] ?? 0;
            $ttl = $pendingRegeneration['ttl_seconds'] ?? self::PENDING_TTL;
            if ($created + $ttl < now()->timestamp) {
                session()->forget('admin_2fa_pending_regeneration');
                $pendingRegeneration = null;
                Cookie::queue(Cookie::forget('admin_2fa_pending'));
            }
        }

        // If session does not contain pending but cookie exists, surface a soft reminder
        $pendingCookie = null;
        if (!$pendingRegeneration && $cookie = Cookie::get('admin_2fa_pending')) {
            try {
                $data = json_decode(decrypt($cookie), true);
                if (!empty($data['expires_at']) && $data['expires_at'] > now()->timestamp) {
                    $pendingCookie = [
                        'created_at' => $data['created_at'],
                        'expires_at' => $data['expires_at'],
                    ];
                } else {
                    Cookie::queue(Cookie::forget('admin_2fa_pending'));
                }
            } catch (\Exception $e) {
                Cookie::queue(Cookie::forget('admin_2fa_pending'));
            }
        }

        // If pending regeneration exists, show setup flow with new data (do NOT reveal old recovery codes)
        if ($pendingRegeneration) {
            $issuer = config('app.name');
            $label = $admin->email;
            $provisioningUri = $this->buildProvisioningUri($issuer, $label, $pendingRegeneration['new_secret']);
            $qrData = QrService::generateDataUri($provisioningUri);

            return view('admin.auth.2fa.setup', [
                'secret' => $pendingRegeneration['new_secret'],
                'provisioningUri' => $provisioningUri,
                'qrData' => $qrData,
                'enabled' => false, // Show setup flow
                'regenerated' => true,
                // newRecovery are the freshly generated codes to display once to the user
                'newRecovery' => $pendingRegeneration['new_recovery_codes'],
                // lightweight client-side reminder if session lost but cookie exists
                'pending_cookie' => $pendingCookie,
            ]);
        }

        // If 2FA already enabled, show a status + actions view (do NOT reveal or regenerate secret here)
        if ($admin->two_factor_enabled) {
            $recovery = $admin->two_factor_recovery_codes ? json_decode($admin->two_factor_recovery_codes, true) : null;
            return view('admin.auth.2fa.setup', [
                'enabled' => true,
                'recoveryCodes' => $recovery,
                'last_changed' => $admin->updated_at,
            ]);
        }

        // If not enabled: ensure a secret exists and show provisioning info so the user can set up
        if (!$admin->two_factor_secret) {
            $admin->two_factor_secret = TwoFactorService::generateSecret(16);
            $admin->save();
        }

        // Build provisioning URI for authenticator apps
        $issuer = config('app.name');
        $label = $admin->email;
        $secret = $admin->two_factor_secret;
        $provisioningUri = $this->buildProvisioningUri($issuer, $label, $secret);

        $qrData = QrService::generateDataUri($provisioningUri);

        return view('admin.auth.2fa.setup', [
            'secret' => $secret,
            'provisioningUri' => $provisioningUri,
            'qrData' => $qrData,
            'enabled' => false,
            'pending_cookie' => $pendingCookie,
        ]);
    }

    /** Enable 2FA after user verifies the generated code */
    public function enable(Request $request)
    {
        $request->validate([
            'code' => ['required', 'digits:6'],
        ]);

        $admin = Auth::guard('admin')->user();

        // Check pending regeneration and TTL (if present)
        $pendingRegeneration = session('admin_2fa_pending_regeneration');
        if ($pendingRegeneration) {
            $created = $pendingRegeneration['created_at'] ?? 0;
            $ttl = $pendingRegeneration['ttl_seconds'] ?? self::PENDING_TTL;
            if ($created + $ttl < now()->timestamp) {
                session()->forget('admin_2fa_pending_regeneration');
                Cookie::queue(Cookie::forget('admin_2fa_pending'));
                return back()->withErrors(['code' => __('app.2fa_regeneration_expired')]);
            }
            // verify against the new secret
            $secret = $pendingRegeneration['new_secret'];
        } else {
            // Normal enable: verify against current secret
            $secret = $admin->two_factor_secret;
        }

        if (!$secret || !TwoFactorService::verifyCode($secret, $request->code)) {
            return back()->withErrors(['code' => __('app.invalid_2fa_code')]);
        }

        if ($pendingRegeneration) {
            // Apply the new secret and recovery codes (commit new data)
            $admin->two_factor_secret = $pendingRegeneration['new_secret'];
            $admin->two_factor_recovery_codes = json_encode($pendingRegeneration['new_recovery_codes']);
            $admin->two_factor_enabled = true; // Ensure it's enabled
            $admin->save();

            // Clear the pending regeneration session and cookie
            session()->forget('admin_2fa_pending_regeneration');
            Cookie::queue(Cookie::forget('admin_2fa_pending'));

            // Log event without sensitive secrets
            ActivityLogger::log(
                'admin',
                $admin->id_administrateur,
                '2fa_regenerate_completed',
                'administrateur',
                $admin->id_administrateur,
                'Completed 2FA regeneration with new secret',
                ['used_pending_flow' => true],
                $request
            );
        } else {
            // Normal enable: Mark 2FA enabled and generate recovery codes
            $admin->two_factor_enabled = true;
            $admin->two_factor_recovery_codes = json_encode(array_map(fn($i) => bin2hex(random_bytes(6)), range(1, 8)));
            $admin->save();

            ActivityLogger::log('admin', $admin->id_administrateur, '2fa_enable', 'administrateur', $admin->id_administrateur, 'Enabled two-factor authentication', null, $request);
        }

        return redirect()->route('admin.2fa.setup')->with('success', __('app.two_factor_enabled'));
    }

    /** Disable 2FA */
    public function disable(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        // Extra server-side guard in case route-level middleware missed it
        if ($admin->role !== 'super_admin') {
            abort(403, __('app.acces_refuse'));
        }

        $admin->two_factor_enabled = false;
        $admin->two_factor_secret = null;
        $admin->two_factor_recovery_codes = null;
        $admin->save();

        ActivityLogger::log('admin', $admin->id_administrateur, '2fa_disable', 'administrateur', $admin->id_administrateur, 'Disabled two-factor authentication', null, $request);

        return redirect()->route('admin.dashboard')->with('success', __('app.two_factor_disabled'));
    }

    /** Show the 2FA challenge form when required */
    public function challenge()
    {
        return view('admin.auth.2fa.challenge');
    }

    /** Show the recovery code form */
    public function recovery()
    {
        return view('admin.auth.2fa.recovery');
    }

    /** Verify a submitted 2FA challenge code */
    public function verify(Request $request)
    {
        // Security check: Ensure this request comes from a valid 2FA challenge flow
        if (!session()->has('admin_2fa_pending')) {
            return redirect()->route('admin.login')
                ->withErrors(['error' => __('app.please_login_first')]);
        }

        // Validation: accept either a 6-digit OTP in 'code' OR a recovery code in 'recovery_code'
        $request->validate([
            'code' => ['nullable', 'digits:6'],
            'recovery_code' => ['nullable', 'string', 'max:64'],
        ]);

        $admin = Auth::guard('admin')->user();
        $secret = $admin->two_factor_secret;

        $providedOtp = $request->input('code');
        $providedRecovery = $request->input('recovery_code');

        // If recovery code is supplied, validate it atomically
        if ($providedRecovery) {
            if (!$admin->two_factor_recovery_codes) {
                return back()->withErrors(['recovery_code' => __('app.no_recovery_codes')]);
            }

            $normalizedInput = strtolower(trim($providedRecovery));

            // We will perform an atomic consume using DB transaction and re-fetch to avoid race.
            try {
                DB::transaction(function () use (&$admin, $normalizedInput, $request) {
                    $fresh = \App\Models\Administrateur::find($admin->id_administrateur);
                    $codes = json_decode($fresh->two_factor_recovery_codes, true) ?: [];

                    foreach ($codes as $storedCode) {
                        if (strtolower(trim($storedCode)) === $normalizedInput) {
                            $newCodes = array_values(array_filter($codes, fn($c) => $c !== $storedCode));
                            $fresh->two_factor_recovery_codes = json_encode($newCodes);
                            $fresh->save();

                            // update $admin reference for further flow
                            $admin = $fresh;

                            // clear the pending flag and set the passed flag
                            session()->forget('admin_2fa_pending');
                            session(['admin_2fa_passed' => true]);

                            ActivityLogger::log('admin', $admin->id_administrateur, '2fa_recovery_used', 'administrateur', $admin->id_administrateur, 'Used a 2FA recovery code', ['recovery_code_consumed' => true], $request);
                            return;
                        }
                    }

                    // If not found in re-fetched list, throw to indicate already consumed
                    throw new \Exception('recovery_code_not_found_or_already_consumed');
                });
            } catch (\Exception $e) {
                // Either already consumed by parallel request or not found
                return back()->withErrors(['recovery_code' => __('app.invalid_recovery_code')]);
            }

            return redirect()->intended(route('admin.dashboard'));
        }

        // Otherwise verify a TOTP OTP
        if (empty($providedOtp) || !$secret || !TwoFactorService::verifyCode($secret, $providedOtp)) {
            return back()->withErrors(['code' => __('app.invalid_2fa_code')]);
        }

        // Clear the pending flag and set the passed flag
        session()->forget('admin_2fa_pending');
        session(['admin_2fa_passed' => true]);

        ActivityLogger::log('admin', $admin->id_administrateur, '2fa_challenge_passed', 'administrateur', $admin->id_administrateur, 'Passed 2FA challenge', null, $request);
        return redirect()->intended(route('admin.dashboard'));
    }

    /**
     * Regenerate a new secret for the current admin.
     * Requires password + current OTP (or recovery code) to avoid accidental/unauthorized re-enrol.
     *
     * SECURITY: The old secret remains ACTIVE until the new secret is verified.
     */
    public function regenerate(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string'],
            'regenerate_code' => ['required', 'string', 'max:64'], // OTP or recovery code
        ]);

        $admin = Auth::guard('admin')->user();

        // confirm identity with password
        if (!Hash::check($request->password, $admin->mot_de_passe)) {
            return back()->withErrors(['password' => __('app.invalid_password')]);
        }

        $currentCode = $request->regenerate_code;
        $secret = $admin->two_factor_secret;

        $usedRecovery = false;
        $ok = false;

        // verify current TOTP
        if ($secret && TwoFactorService::verifyCode($secret, $currentCode)) {
            $ok = true;
        }

        // If not OK yet, try to atomically consume a recovery code
        if (!$ok && $admin->two_factor_recovery_codes) {
            $normalizedInput = strtolower(trim($currentCode));
            try {
                DB::transaction(function () use (&$admin, $normalizedInput, &$usedRecovery) {
                    $fresh = \App\Models\Administrateur::find($admin->id_administrateur);
                    $codes = json_decode($fresh->two_factor_recovery_codes, true) ?: [];

                    foreach ($codes as $storedCode) {
                        if (strtolower(trim($storedCode)) === $normalizedInput) {
                            $newCodes = array_values(array_filter($codes, fn($c) => $c !== $storedCode));
                            $fresh->two_factor_recovery_codes = json_encode($newCodes);
                            $fresh->save();

                            $admin = $fresh;
                            $usedRecovery = true;
                            return;
                        }
                    }

                    throw new \Exception('recovery_code_not_found');
                });

                // If we consumed one, treat it as ok
                if ($usedRecovery) {
                    $ok = true;
                }
            } catch (\Exception $e) {
                // not found or already consumed
                $ok = false;
            }
        }

        if (!$ok) {
            return back()->withErrors(['regenerate_code' => __('app.invalid_2fa_code')]);
        }

        // Generate new secret and recovery codes
        $newSecret = TwoFactorService::generateSecret(24);
        $newCodes = array_map(fn($i) => bin2hex(random_bytes(6)), range(1, 8));

        // SECURITY: Store new secret in SESSION with TTL, do NOT store old recovery codes.
        $pending = [
            'new_secret' => $newSecret,
            'new_recovery_codes' => $newCodes,
            'created_at' => now()->timestamp,
            'old_secret_hash' => $admin->two_factor_secret ? hash_hmac('sha256', $admin->two_factor_secret, config('app.key')) : null,
            'ttl_seconds' => self::PENDING_TTL,
        ];

        session(['admin_2fa_pending_regeneration' => $pending]);

        // Queue a small encrypted cookie as a reminder flag (no secrets stored in cookie)
        $minutes = (int) ceil($pending['ttl_seconds'] / 60);
        try {
            $cookiePayload = encrypt(json_encode([
                'created_at' => $pending['created_at'],
                'expires_at' => $pending['created_at'] + $pending['ttl_seconds'],
            ]));
            Cookie::queue(cookie('admin_2fa_pending', $cookiePayload, $minutes, null, null, false, true));
        } catch (\Exception $e) {
            // If cookie encryption/queue fails, continue silently (session still holds pending)
        }

        ActivityLogger::log('admin', $admin->id_administrateur, '2fa_regenerate_initiated', 'administrateur', $admin->id_administrateur, 'Initiated 2FA regeneration (pending verification)', ['used_recovery' => $usedRecovery], $request);

        // Build provisioning info for the new secret
        $issuer = config('app.name');
        $label = $admin->email;
        $provisioningUri = $this->buildProvisioningUri($issuer, $label, $newSecret);
        $qrData = QrService::generateDataUri($provisioningUri);

        return view('admin.auth.2fa.setup', [
            'secret' => $newSecret,
            'provisioningUri' => $provisioningUri,
            'qrData' => $qrData,
            'enabled' => false, // Show setup flow for regeneration
            'regenerated' => true,
            'newRecovery' => $newCodes,
        ]);
    }



    public function clearPending(Request $request)
    {
        session()->forget('admin_2fa_pending_regeneration');
        \Illuminate\Support\Facades\Cookie::queue(\Illuminate\Support\Facades\Cookie::forget('admin_2fa_pending'));

        if ($request->wantsJson()) {
            return response()->json(['ok' => true]);
        }

        return redirect()->route('admin.2fa.setup');
    }
}
