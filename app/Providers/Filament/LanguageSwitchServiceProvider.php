<?php

namespace App\Providers\Filament;

use Illuminate\Support\ServiceProvider;
use Bezhansalleh\FilamentLanguageSwitch\LanguageSwitch;

class LanguageSwitchServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        LanguageSwitch::configureUsing(function (LanguageSwitch $switch) {
            $switch
                ->locales(['ar', 'en', 'fr']) // Curated from your resources/lang folder
                ->labels([
                    'ar' => 'العربية',
                    'en' => 'English',
                    'fr' => 'Français',
                ]);
        });
    }
}
