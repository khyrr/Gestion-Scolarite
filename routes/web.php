<?php

use App\Http\Controllers\ClasseController;
use App\Http\Controllers\CoursController;
use App\Http\Controllers\EnseignantController;
use App\Http\Controllers\EnseignPaiementController;
use App\Http\Controllers\EtudePaiementController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ConfirmPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\EnseignantDashboardController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\EtudiantDashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Clean, organized route structure for School Management System
| Grouped by functionality with proper naming conventions
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| Language Switching Routes
|--------------------------------------------------------------------------
*/
Route::get('/langue/{locale}', function ($locale) {
    $available = array_keys(config('locales', ['fr' => [], 'ar' => [], 'en' => []]));
    if (in_array($locale, $available, true)) {
        session(['locale' => $locale]);
        app()->setLocale($locale);
    }
    return redirect()->back();
})->name('lang.switch');

/*
|--------------------------------------------------------------------------
| Routes Publiques
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
})->name('accueil');

// Health check endpoint - restricted in production
Route::get('/health', function () {
    // Simple health check for production - just returns OK
    if (config('app.env') === 'production') {
        return response()->json([
            'status' => 'OK',
            'timestamp' => now()->toIso8601String(),
        ]);
    }

    // Detailed health check for development/staging
    try {
        $dbStatus = DB::connection()->getPdo() ? 'connected' : 'disconnected';
    } catch (\Exception $e) {
        $dbStatus = 'error: ' . $e->getMessage();
    }

    return response()->json([
        'status' => 'OK',
        'timestamp' => now()->toIso8601String(),
        'app' => config('app.name'),
        'env' => config('app.env'),
        'database' => $dbStatus,
        'php_version' => PHP_VERSION,
        'laravel_version' => app()->version(),
    ]);
})->middleware('throttle:60,1'); // Rate limit: 60 requests per minute

/*
|--------------------------------------------------------------------------
| Routes d'Authentification Admin
|--------------------------------------------------------------------------
*/
Route::prefix(config('admin.prefix'))->name('admin.')->middleware('admin.ip')->group(function () {
    // Admin-specific language switch route so the admin session cookie is used
    Route::get('/langue/{locale}', function ($locale) {
        $available = array_keys(config('locales', ['fr' => [], 'ar' => [], 'en' => []]));
        if (in_array($locale, $available, true)) {
            session(['locale' => $locale]);
            app()->setLocale($locale);
        }
        return redirect()->back();
    })->name('lang.switch');
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    // Dashboard route (protected)
    Route::get('/dashboard', [App\Http\Controllers\Admin\AdminDashboardController::class, 'index'])
        ->name('dashboard')
        ->middleware(['auth:admin', 'require.2fa:if_enabled']);

    // IP Whitelist Management
    Route::get('/settings/ip', [App\Http\Controllers\Admin\AdminIpController::class, 'index'])
        ->name('settings.ip')
        ->middleware(['auth:admin', 'require.super_admin']);

    Route::post('/settings/ip', [App\Http\Controllers\Admin\AdminIpController::class, 'store'])
        ->name('settings.ip.store')
        ->middleware(['auth:admin', 'require.super_admin', 'require.2fa']);

    Route::patch('/settings/ip/{ip}/toggle', [App\Http\Controllers\Admin\AdminIpController::class, 'toggle'])
        ->name('settings.ip.toggle')
        ->middleware(['auth:admin', 'require.super_admin', 'require.2fa']);

    Route::delete('/settings/ip/{ip}', [App\Http\Controllers\Admin\AdminIpController::class, 'destroy'])
        ->name('settings.ip.destroy')
        ->middleware(['auth:admin', 'require.super_admin', 'require.2fa']);

    // Activity log viewer / export
    Route::get('/logs', [App\Http\Controllers\Admin\ActivityLogController::class, 'index'])->name('logs.index')->middleware('auth:admin');
    Route::get('/logs/export', [App\Http\Controllers\Admin\ActivityLogController::class, 'export'])->name('logs.export')->middleware('auth:admin');

    // Two-Factor Authentication management
    // 2FA management: only super_admins are allowed to setup/enable/disable their 2FA
    // Both super_admin and normal admin may enroll and enable 2FA for their own account
    Route::get('/2fa/setup', [App\Http\Controllers\Admin\TwoFactorController::class, 'showSetup'])
        ->name('2fa.setup')
        ->middleware(['auth:admin']);

    Route::post('/2fa/enable', [App\Http\Controllers\Admin\TwoFactorController::class, 'enable'])
        ->name('2fa.enable')
        ->middleware(['auth:admin']);

    // Regenerate secret (step-up required)
    Route::post('/2fa/regenerate', [App\Http\Controllers\Admin\TwoFactorController::class, 'regenerate'])
        ->name('2fa.regenerate')
        ->middleware(['auth:admin']);

    // Only super_admins can disable 2FA for themselves (or others)
    Route::post('/2fa/disable', [App\Http\Controllers\Admin\TwoFactorController::class, 'disable'])
        ->name('2fa.disable')
        ->middleware(['auth:admin', 'require.super_admin']);

    Route::post('/2fa/clear-pending', [\App\Http\Controllers\Admin\TwoFactorController::class, 'clearPending'])
        ->name('2fa.clear_pending')
        ->middleware(['auth:admin', 'throttle:10,1']);


    // 2FA challenge when required - protected by middleware to ensure prior authentication
    Route::middleware(['require.2fa.challenge'])->group(function () {
        Route::get('/2fa/challenge', [App\Http\Controllers\Admin\TwoFactorController::class, 'challenge'])->name('2fa.challenge');
        Route::get('/2fa/recovery', [App\Http\Controllers\Admin\TwoFactorController::class, 'recovery'])->name('2fa.recovery');
        Route::post('/2fa/verify', [App\Http\Controllers\Admin\TwoFactorController::class, 'verify'])->name('2fa.verify');
    });

    // Admin Management
    // List and manage administrators (super admin only, 2FA required)
    Route::get('/admins', [App\Http\Controllers\Admin\AdminManagementController::class, 'index'])
        ->name('admins.index')
        ->middleware(['auth:admin', 'require.super_admin', 'require.2fa']);

    Route::post('/admins/{admin}/toggle-2fa', [App\Http\Controllers\Admin\AdminManagementController::class, 'toggle2fa'])
        ->name('admins.toggle_2fa')
        ->middleware(['auth:admin', 'require.super_admin', 'require.2fa']);

    Route::get('/admins/create', [App\Http\Controllers\Admin\AdminManagementController::class, 'create'])->name('admins.create')->middleware('auth:admin');
    Route::post('/admins', [App\Http\Controllers\Admin\AdminManagementController::class, 'store'])->name('admins.store')->middleware('auth:admin');


    /*
    |--------------------------------------------------------------------------
    | Academic Management Routes (Admin)
    |--------------------------------------------------------------------------
    */
    Route::middleware(['auth:admin', 'require.2fa:if_enabled'])->group(function () {
        // Classes
        Route::resource('classes', ClasseController::class);

        // Etudiants
        Route::resource('etudiants', EtudiantController::class);

        // Enseignants
        Route::resource('enseignants', EnseignantController::class);

        // Cours
        Route::get('cours/spectacle', [CoursController::class, 'spectacle'])->name('cours.spectacle');
        Route::resource('cours', CoursController::class);

        // Evaluations
        Route::resource('evaluations', EvaluationController::class);

        // Notes
        Route::resource('notes', NoteController::class);

        // Rapports
        Route::prefix('rapports')->name('rapports.')->group(function () {
            Route::get('notes/transcript', [NoteController::class, 'transcriptIndex'])->name('notes.transcript-index');
            Route::post('notes/transcript', [NoteController::class, 'generateTranscript'])->name('notes.transcript-generate');
            Route::get('notes/devoirs/niveau-{level}', [NoteController::class, 'homeworkReports'])->name('notes.devoirs')->where('level', '[0-9]+');
        });

        // Paiements
        Route::prefix('paiements')->name('paiements.')->group(function () {
            Route::get('/', function () {
                return view('payments.index');
            })->name('index');
            Route::resource('etudiants', EtudePaiementController::class);
            Route::resource('enseignants', EnseignPaiementController::class);
        });

        // Utilitaires
        Route::get('recherche', [SearchController::class, 'index'])->name('recherche');
        Route::get('publications', function () {
            return view('publications.index');
        })->name('publications');
    });
});

// Keep global versions of password-reset & verification routes for non-teacher users
// (these are the legacy route names used by some views and the framework). They point
// to the same controllers so behavior is identical; teacher endpoints also remain
// available under `/enseignant` and `enseignant.*` names.
// Password reset (French localized URIs) - global
Route::get('/mot-de-passe/reinitialiser', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('mot-de-passe.demande');
Route::post('/mot-de-passe/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('mot-de-passe.email');
Route::get('/mot-de-passe/reinitialiser/{token}', [ResetPasswordController::class, 'showResetForm'])->name('mot-de-passe.reinitialiser');
Route::post('/mot-de-passe/reinitialiser', [ResetPasswordController::class, 'reset'])->name('mot-de-passe.mise-a-jour');
Route::get('/mot-de-passe/confirmer', [ConfirmPasswordController::class, 'showConfirmForm'])->name('mot-de-passe.confirmer');
Route::post('/mot-de-passe/confirmer', [ConfirmPasswordController::class, 'confirm'])->name('mot-de-passe.confirmation');

// Email verification (French localized URIs) - global
Route::get('/courriel/verifier', [VerificationController::class, 'show'])->name('verification.notice');
Route::get('/courriel/verifier/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify')->middleware(['signed']);
Route::post('/courriel/renvoyer-verification', [VerificationController::class, 'resend'])->name('verification.resend');

/*
|--------------------------------------------------------------------------
| Routes d'Authentification
|--------------------------------------------------------------------------
*/

// Public (teacher) authentication routes grouped under /enseignant
Route::prefix('enseignant')->name('enseignant.')->group(function () {
    // Teacher-scoped language switch so teacher session cookie is used when switching
    Route::get('/langue/{locale}', function ($locale) {
        $available = array_keys(config('locales', ['fr' => [], 'ar' => [], 'en' => []]));
        if (in_array($locale, $available, true)) {
            session(['locale' => $locale]);
            app()->setLocale($locale);
        }
        return redirect()->back();
    })->name('lang.switch');
    // Connexion (login)
    Route::get('/connexion', [LoginController::class, 'showLoginForm'])->name('connexion');
    Route::post('/connexion', [LoginController::class, 'login'])->name('connexion.submit');

    // Deconnexion (logout)
    Route::post('/deconnexion', [LogoutController::class, 'logout'])->name('deconnexion');

    // Inscription (registration)
    Route::get('/inscription', [RegisterController::class, 'showRegistrationForm'])->name('inscription');
    Route::post('/inscription', [RegisterController::class, 'register'])->name('inscription.submit');
});

// Password reset and email verification routes for teachers (Enseignant)
// These routes live under /enseignant so they match the other teacher auth routes
Route::prefix('enseignant')->name('enseignant.')->group(function () {
    // Password reset (French localized URIs)
    Route::get('/mot-de-passe/reinitialiser', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('mot-de-passe.demande');
    Route::post('/mot-de-passe/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('mot-de-passe.email');
    Route::get('/mot-de-passe/reinitialiser/{token}', [ResetPasswordController::class, 'showResetForm'])->name('mot-de-passe.reinitialiser');
    Route::post('/mot-de-passe/reinitialiser', [ResetPasswordController::class, 'reset'])->name('mot-de-passe.mise-a-jour');
    Route::get('/mot-de-passe/confirmer', [ConfirmPasswordController::class, 'showConfirmForm'])->name('mot-de-passe.confirmer');
    Route::post('/mot-de-passe/confirmer', [ConfirmPasswordController::class, 'confirm'])->name('mot-de-passe.confirmation');

    // Email verification (French localized URIs)
    Route::get('/courriel/verifier', [VerificationController::class, 'show'])->name('verification.notice');
    Route::get('/courriel/verifier/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify')->middleware(['signed']);
    Route::post('/courriel/renvoyer-verification', [VerificationController::class, 'resend'])->name('verification.resend');
});

/*
|--------------------------------------------------------------------------
| Routes du Tableau de Bord
|--------------------------------------------------------------------------
*/


/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
| All routes requiring authentication grouped by functionality
*/

/*
|--------------------------------------------------------------------------
| Role-Based Dashboard Routes
|--------------------------------------------------------------------------
| Separate dashboards for different user roles with proper middleware
*/

// Teacher (Enseignant) Dashboard Routes
Route::middleware(['auth', 'role:enseignant'])->prefix('enseignant')->name('enseignant.')->group(function () {
    Route::get('/dashboard', [EnseignantDashboardController::class, 'index'])->name('dashboard');
    Route::get('/mes-etudiants', [EnseignantDashboardController::class, 'mesEtudiants'])->name('mes-etudiants');
    Route::get('/mes-cours', [EnseignantDashboardController::class, 'mesCours'])->name('mes-cours');
    Route::get('/saisir-notes', [EnseignantDashboardController::class, 'saisirNotes'])->name('saisir-notes');

    // Teacher profile routes
    Route::get('/profil', [EnseignantDashboardController::class, 'profil'])->name('profil');
    Route::put('/profil', [EnseignantDashboardController::class, 'updateProfil'])->name('profil.update');

    // Teacher note management routes
    Route::get('/notes/create/{etudiant}/{evaluation}', [NoteController::class, 'create'])->name('notes.create');
    Route::post('/notes', [NoteController::class, 'store'])->name('notes.store');
    Route::get('/notes/{note}/edit', [NoteController::class, 'edit'])->name('notes.edit');
    Route::put('/notes/{note}', [NoteController::class, 'update'])->name('notes.update');
    Route::delete('/notes/{note}', [NoteController::class, 'destroy'])->name('notes.destroy');
});

/*
|--------------------------------------------------------------------------
| Student (Etudiant) Dashboard Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:etudiant'])->prefix('etudiant')->name('etudiant.')->group(function () {
    Route::get('/dashboard', [EtudiantDashboardController::class, 'index'])->name('dashboard');
    Route::get('/mes-notes', [EtudiantDashboardController::class, 'mesNotes'])->name('mes-notes');
    Route::get('/mon-emploi', [EtudiantDashboardController::class, 'monEmploi'])->name('mon-emploi');
});

/*
|--------------------------------------------------------------------------
| Public Routes for Students (No Login Required)
|--------------------------------------------------------------------------
| Students don't have user accounts - they use public access with matricule
*/

// Public transcript search - no authentication required
Route::get('/rechercher-notes', [NoteController::class, 'publicTranscriptSearch'])->name('public.transcript.search');
Route::get('/mon-releve/{matricule}/trimestre-{trimestre}', [NoteController::class, 'publicTranscript'])->name('public.transcript.show')->where('trimestre', '[1-3]');
Route::get('/mon-releve/{matricule}', [NoteController::class, 'publicTranscript'])->name('public.transcript.show.full');
