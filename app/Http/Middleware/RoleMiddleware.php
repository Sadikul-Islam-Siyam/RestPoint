<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to access this page.');
        }

        $user = auth()->user();

        // Admin satisfies admin
        if ($role === 'admin' && !$user->isAdmin()) {
            abort(403, 'Unauthorized action. Admin role required.');
        }

        // Moderator satisfies moderator or admin
        if ($role === 'moderator' && !$user->isModerator()) {
            abort(403, 'Unauthorized action. Moderator role required.');
        }

        return $next($request);
    }
}
