<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if ($request->expectsJson()) {
            return null;
        }

        // Match both the literal 'admin' URI and the configured admin prefix
        $adminPrefix = trim(config('admin.prefix', 'admin'), '/');
        if ($request->is('admin') || $request->is('admin/*') || ($adminPrefix && ($request->is($adminPrefix) || $request->is($adminPrefix.'/*')))) {
            return route('admin.login');
        }

        return route('enseignant.connexion');
    }
}
