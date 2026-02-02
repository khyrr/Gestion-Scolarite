<?php

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
    // If user is authenticated, redirect to appropriate panel
    if (auth()->check()) {
        $redirectPath = \App\Services\RoleRedirectService::getRedirectPath(auth()->user());
        return redirect($redirectPath);
    }
    
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

