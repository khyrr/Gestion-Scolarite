<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetSessionCookieByGuard
{
    /**
     * Set the session cookie name based on the request prefix so different
     * guards (admin / teacher) don't collide in the same browser.
     */
    public function handle(Request $request, Closure $next)
    {
        $default = config('session.cookie');

        // Admin area: give its own cookie name
        $adminPrefix = trim(config('admin.prefix', 'control-panel'), '/');
        $path = $request->path();

        if ($adminPrefix && str_starts_with($path, $adminPrefix)) {
            config(['session.cookie' => $default . '_admin']);
        } elseif (str_starts_with($path, 'enseignant')) {
            config(['session.cookie' => $default . '_teacher']);
        } else {
            config(['session.cookie' => $default]);
        }

        return $next($request);
    }
}
