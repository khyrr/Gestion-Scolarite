<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class LivewireServiceProvider extends ServiceProvider
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
        // Disable Livewire release token verification temporarily
        // This is to debug the 419 error issue
        Livewire::listen('checksum.verify', function () {
            return true;
        }, priority: -100);
    }
}
