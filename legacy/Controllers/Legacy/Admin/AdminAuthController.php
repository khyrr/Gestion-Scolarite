<?php

namespace App\Http\Controllers\Legacy\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\ActivityLogger;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Response;

class AdminAuthController extends Controller
{
    use ThrottlesLogins;
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('old_admin_pages.admin.auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        // Throttle admin login attempts
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            $user = Auth::user();

            if (!$user->isAdmin()) {
                Auth::logout();
                return back()->withInput($request->only('email', 'remember'))->withErrors([
                    'email' => 'Access denied. Not an administrator.',
                ]);
            }

            // Log successful admin login
            ActivityLogger::log('admin', $user->id, 'login', 'user', $user->id, 'Admin login');
            $this->clearLoginAttempts($request);
            // Clear any previous 2FA session marker so a fresh challenge is required
            session()->forget('admin_2fa_passed');

            // If admin has 2FA enabled, send them to the challenge step so they must verify
            if ($user->two_factor_enabled) {
                // Set a temporary session flag to indicate pending 2FA verification
                // This ensures the challenge page can only be accessed after password auth
                session(['admin_2fa_pending' => true]);
                return redirect()->route('admin.2fa.challenge');
            }

            return redirect()->intended(route('admin.dashboard'));
        }

        // Increment attempts and return error
        $this->incrementLoginAttempts($request);

        // Log failed admin login
        ActivityLogger::log('admin', null, 'failed_login', null, null, 'Failed login attempt for ' . $request->email);

        return back()->withInput($request->only('email', 'remember'))->withErrors([
            'email' => 'email_ou_mot_de_passe_incorrects',
        ]);
    }

    /**
     * Username field used by ThrottlesLogins
     */
    public function username()
    {
        return 'email';
    }

    /**
     * Admin-specific throttle: 3 attempts
     */
    protected function maxAttempts()
    {
        return 3;
    }

    /**
     * Admin-specific decay minutes: 15
     */
    protected function decayMinutes()
    {
        return 15;
    }

    public function logout()
    {
        $userId = Auth::id();
        Auth::logout();
        // Ensure 2FA pass marker is removed on logout (session may persist)
        session()->forget('admin_2fa_passed');
        if ($userId) {
            ActivityLogger::log('admin', $userId, 'logout', 'user', $userId, 'Admin logout');
        }
        return redirect()->route('admin.login');
    }
}
