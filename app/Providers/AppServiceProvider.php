<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\URL;
use Illuminate\Pagination\Paginator;
use Filament\Facades\Filament;
use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;

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
            return auth()->check() && auth()->user()->isAdmin();
        });
        
        // Add custom Blade directive for admin or teacher check
        Blade::if('adminOrTeacher', function () {
            return auth()->check() && (auth()->user()->isAdmin() || auth()->user()->isTeacher());
        });
        
        Filament::serving(function () {
            FilamentAsset::register([
                Css::make('flatpickr', 'https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css'),
                Js::make('flatpickr', 'https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.js'),
                Js::make('flatpickr-course-timepicker')
                    ->html(<<<'JS'
                        <script>
                        (() => {
                            const selector = 'input[data-timepicker]';

                            const initialize = () => {
                                if (typeof window.flatpickr === 'undefined') {
                                    window.setTimeout(initialize, 50);
                                    return;
                                }

                                document.querySelectorAll(selector).forEach((input) => {
                                    if (input._flatpickr) {
                                        input._flatpickr.destroy();
                                    }

                                    const format = input.dataset.timeFormat ?? 'H:i';
                                    const isTwentyFourHour = format.includes('H') && !format.includes('h');

                                    window.flatpickr(input, {
                                        enableTime: true,
                                        noCalendar: true,
                                        dateFormat: format,
                                        time_24hr: isTwentyFourHour,
                                        allowInput: true,
                                    });
                                });
                            };

                            const events = ['DOMContentLoaded', 'filament:load', 'livewire:load', 'livewire:update', 'turbo:load'];

                            events.forEach((event) => document.addEventListener(event, initialize));
                            initialize();
                        })();
                        </script>
                    JS),
            ]);
        });
    }
}
