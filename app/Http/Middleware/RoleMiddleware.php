<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $role
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Check if user is authenticated
        if (!auth()->check()) {
            return redirect()->route('enseignant.connexion')->with('error', __('app.login_required'));
        }

        $user = auth()->user();
        
        // Check if user account is active (if the attribute exists)
        if (isset($user->is_active) && !$user->is_active) {
            auth()->logout();
            return redirect()->route('enseignant.connexion')->with('error', __('app.account_deactivated'));
        }
        
        // Check if user has the required role
        if (!$this->hasRole($user, $role)) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => __('app.unauthorized_access')
                ], 403);
            }
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard')->with('error', __('app.acces_refuse'));
            }
            if ($user->role === 'enseignant') {
                return redirect()->route('enseignant.dashboard')->with('error', __('app.acces_refuse'));
            }

            return redirect()->route('accueil')->with('error', __('app.acces_refuse'));
        }

        return $next($request);
    }

    /**
     * Check if user has the specified role
     */
    private function hasRole($user, string $role): bool
    {
        // Multiple roles separated by |
        if (str_contains($role, '|')) {
            $roles = explode('|', $role);
            foreach ($roles as $singleRole) {
                if ($user->hasRole(trim($singleRole))) {
                    return true;
                }
            }
            return false;
        }
        
        // Single role check
        return $user->hasRole($role);
    }
}
