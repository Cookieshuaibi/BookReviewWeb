<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle($request, Closure $next, ...$roles)
    {
        // Check if user is logged in and has the required roles
        // If not, abort with 403 error
        if (!Auth::check() || !auth()->user()->hasAnyRoles($roles)) {
            echo "You are not authorized to access this page.";exit;
            abort(403);
        }

        return $next($request);
    }
}