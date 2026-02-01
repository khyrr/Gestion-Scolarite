<?php

namespace App\Http\Controllers\Legacy\Admin;

use App\Http\Controllers\Controller;
use App\Models\Administrateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Services\TwoFactorService;
use App\Services\ActivityLogger;
use App\Models\User;

class AdminManagementController extends Controller
{
    public function __construct()
    {
        // Ensure only authenticated admins with the super_admin role can manage administrators
        $this->middleware('auth');

        $this->middleware(function ($request, $next) {
            $user = auth()->user();

            if (! $user || ! $user->hasRole('super_admin')) {
                abort(403, 'Only super administrators can manage administrator accounts.');
            }

            return $next($request);
        })->only(['create', 'store']);
    }

    /**
     * Display a listing of administrators for management.
     */
    public function index()
    {
        $admins = User::where('profile_type', Administrateur::class)
            ->with('profile')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('old_admin_pages.admin.users.index', compact('admins'));
    }

    /**
     * Toggle 2FA for a target administrator. Requires the acting super-admin to provide a valid TOTP code.
     */
    public function toggle2fa(Request $request, $admin)
    {
        $request->validate([
            'confirmation_code' => ['required', 'digits:6'],
        ]);

        $actor = auth()->user()->profile;

        // Verify actor's current OTP
        if (! $actor->two_factor_secret || ! TwoFactorService::verifyCode($actor->two_factor_secret, $request->confirmation_code)) {
            if ($request->wantsJson()) {
                return response()->json(['errors' => ['confirmation_code' => [__('app.invalid_2fa_code')]]], 422);
            }
            return back()->withErrors(['confirmation_code' => __('app.invalid_2fa_code')]);
        }

        $target = Administrateur::findOrFail($admin);

        // Prevent toggling self from this interface
        if ($target->id_administrateur === $actor->id_administrateur) {
            if ($request->wantsJson()) {
                return response()->json(['message' => __('app.cannot_manage_self')], 403);
            }
            return back()->with('error', __('app.cannot_manage_self'));
        }

        if ($target->two_factor_enabled) {
            // Disable
            $target->two_factor_enabled = false;
            $target->two_factor_secret = null;
            $target->two_factor_recovery_codes = null;
            $target->save();

            ActivityLogger::log('admin', $actor->id_administrateur, '2fa_disabled_for_other', 'administrateur', $target->id_administrateur, 'Disabled 2FA for admin '.$target->email);

            if ($request->wantsJson()) {
                return response()->json(['message' => __('app.two_factor_disabled_for_admin', ['email' => $target->email])]);
            }
            return back()->with('success', __('app.two_factor_disabled_for_admin', ['email' => $target->email]));
        }

        // Enable: generate secret + recovery codes and enable immediately. Admin will need these to complete setup.
        $secret = TwoFactorService::generateSecret(24);
        $recovery = array_map(fn($i) => bin2hex(random_bytes(6)), range(1, 8));

        $target->two_factor_secret = $secret;
        $target->two_factor_recovery_codes = json_encode($recovery);
        $target->two_factor_enabled = true;
        $target->save();

        ActivityLogger::log('admin', $actor->id_administrateur, '2fa_enabled_for_other', 'administrateur', $target->id_administrateur, 'Enabled 2FA for admin '.$target->email);

        // For now we do not render the secret in the UI here automatically – the super-admin must deliver it to the target securely.
        if ($request->wantsJson()) {
            return response()->json(['message' => __('app.two_factor_enabled_for_admin', ['email' => $target->email])]);
        }
        return back()->with('success', __('app.two_factor_enabled_for_admin', ['email' => $target->email]));
    }
    /**
     * Show the form for creating a new admin.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('old_admin_pages.admin.users.create-admin');
    }

    /**
     * Store a newly created admin in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'string', 'in:admin,super_admin'],
        ]);

        $created = \Illuminate\Support\Facades\DB::transaction(function () use ($request) {
            $admin = Administrateur::create([
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $user = \App\Models\User::create([
                'name' => $request->nom . ' ' . $request->prenom,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'profile_type' => Administrateur::class,
                'profile_id' => $admin->id_administrateur,
            ]);
            
            // Assign role using Spatie
            if ($request->role) {
                $user->assignRole($request->role);
            }

            return $admin;
        });

        // Log admin creation
        \App\Services\ActivityLogger::log('admin', auth()->user()->profile->id_administrateur, 'create', 'administrateur', $created->id_administrateur, 'Created new admin ' . $created->email);

        return redirect()->route('admin.dashboard')->with('success', 'Nouvel administrateur créé avec succès.');
    }
}
