<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
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
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());
            $maxAttempts = (int) setting('security.max_login_attempts', 5);
            $lockoutDuration = (int) setting('security.lockout_duration', 15); // minutes

            // Return rate limit with proper decay time in minutes
            return Limit::perMinutes($lockoutDuration, $maxAttempts)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            $maxAttempts = (int) setting('security.max_login_attempts', 5);
            $lockoutDuration = (int) setting('security.lockout_duration', 15); // minutes
            
            return Limit::perMinutes($lockoutDuration, $maxAttempts)->by($request->session()->get('login.id'));
        });
    }
}
