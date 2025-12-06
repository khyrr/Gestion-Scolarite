<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class TeacherMiddleware
{
    /**
     * Ensure the request is authenticated and the authenticated user is a teacher.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthenticated.'], 401);
            }
            return redirect()->route('login')->with('error', __('app.login_required'));
        }

        $user = Auth::user();

        if (!$user->isTeacher()) {
            if ($request->expectsJson()) {
                return response()->json(['message' => __('app.unauthorized_access')], 403);
            }
            return redirect()->route('accueil')->with('error', __('app.acces_refuse'));
        }

        if (!$user->is_active) {
            Auth::logout();
            return redirect()->route('login')->with('error', __('app.account_deactivated'));
        }

        return $next($request);
    }
}
