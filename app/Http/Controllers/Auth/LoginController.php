<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:teacher')->except('logout');
    }

    /**
     * Get the post-authentication redirect path.
     */
    protected function redirectTo()
    {
        // Prefer admin guard first, then teacher guard. This keeps correct
        // post-login redirection for both auth systems.
        if (Auth::guard('admin')->check()) {
            return RouteServiceProvider::HOME;
        }

        if (Auth::guard('teacher')->check()) {
            return route('enseignant.dashboard');
        }

        $user = Auth::user();
        
        if (!$user) {
            return RouteServiceProvider::HOME;
        }

        // Check if user is active
            if (!$user->is_active) {
            Auth::logout();
            return redirect()->route('enseignant.connexion')->with('error', __('app.account_deactivated'));
        }
        
        // Role-based redirect
        switch ($user->role) {
            case 'admin':
                return RouteServiceProvider::HOME; // Admin dashboard
            case 'enseignant':
                return route('enseignant.dashboard'); // Teacher dashboard
            default:
                return RouteServiceProvider::HOME;
        }
    }

    /**
     * Use the teacher guard for this controller (teacher login flow).
     */
    protected function guard()
    {
        return Auth::guard('teacher');
    }

    /**
     * Handle a login request to the application.
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        // Check for too many login attempts
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        // Attempt to log the user in
        if ($this->attemptLogin($request)) {
            // Log successful teacher login
            \App\Services\ActivityLogger::log('teacher', Auth::guard('teacher')->id(), 'login', 'enseignant', Auth::guard('teacher')->id(), 'Teacher login');
            $user = Auth::user();
            
            // Check if user is active
            if (!$user->is_active) {
                Auth::logout();
                return redirect()->back()
                    ->withInput($request->only($this->username(), 'remember'))
                    ->withErrors([
                        $this->username() => __('app.account_deactivated'),
                    ]);
            }
            
            return $this->sendLoginResponse($request);
        }

        // Increment login attempts
        $this->incrementLoginAttempts($request);

        // Log failed teacher login
        \App\Services\ActivityLogger::log('teacher', null, 'failed_login', null, null, 'Failed login attempt for '.$request->email);

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Number of allowed attempts for teacher logins.
     */
    protected function maxAttempts()
    {
        return 5; // 5 attempts
    }

    /**
     * Decay minutes for teacher login attempts.
     */
    protected function decayMinutes()
    {
        return 10; // 10 minutes
    }

    /**
     * Show the application's login form.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('enseignant.connexion')->with('success', __('app.logged_out_successfully'));
    }
}
