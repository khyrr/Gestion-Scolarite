<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class TeacherMiddleware
{
    /**
     * Ensure the request is authenticated by the teacher guard and the
     * authenticated user is a teacher (role == 'enseignant').
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Use the 'teacher' guard we added to config/auth.php
        if (!Auth::guard('teacher')->check()) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthenticated.'], 401);
            }
            return redirect()->route('enseignant.connexion')->with('error', __('app.login_required'));
        }

        $user = Auth::guard('teacher')->user();

        if (! $user || ! $user->hasRole('enseignant')) {
            if ($request->expectsJson()) {
                return response()->json(['message' => __('app.unauthorized_access')], 403);
            }
            return redirect()->route('accueil')->with('error', __('app.acces_refuse'));
        }

        if (property_exists($user, 'is_active') && ! $user->is_active) {
            Auth::guard('teacher')->logout();
            return redirect()->route('enseignant.connexion')->with('error', __('app.account_deactivated'));
        }

        return $next($request);
    }
}
