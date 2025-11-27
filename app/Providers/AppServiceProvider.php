<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\URL;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
        
        // Force HTTPS in production
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
        
        // Use Bootstrap 5 for pagination
        Paginator::useBootstrapFive();
        
        // Add custom Blade directive for admin check
        Blade::if('admin', function () {
            if (auth('admin')->check()) {
                return true;
            }
            
            return auth()->check() && method_exists(auth()->user(), 'hasRole') &&
                   (auth()->user()->hasRole('admin') || auth()->user()->hasRole('administrateur'));
        });
        
        // Add custom Blade directive for admin or teacher check
        Blade::if('adminOrTeacher', function () {
            if (auth('admin')->check()) {
                return true;
            }

            return auth()->check() && method_exists(auth()->user(), 'hasRole') &&
                   (auth()->user()->hasRole('admin') || 
                    auth()->user()->hasRole('administrateur') || 
                    auth()->user()->hasRole('enseignant'));
        });
    }
}
