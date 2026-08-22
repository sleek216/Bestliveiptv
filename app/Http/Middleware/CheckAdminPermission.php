<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $permission): Response
    {
        // Check if user is logged in
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please login to access admin panel.');
        }

        // Check if user is an admin
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Access denied. Admin privileges required.');
        }

        // Check if user has specific permission
        if (!auth()->user()->hasAdminPermission($permission)) {
            abort(403, 'Access denied. You do not have permission to access the ' . ucfirst($permission) . ' section.');
        }

        return $next($request);
    }
}
