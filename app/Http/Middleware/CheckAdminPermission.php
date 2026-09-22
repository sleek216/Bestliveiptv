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
            return redirect()->route('staff.login')->with('error', 'Please login to access staff dashboard.');
        }

        $user = auth()->user();

        // Check if user is an admin or employee
        if (!$user->isAdmin()) {
            abort(403, 'Access denied. Staff privileges required.');
        }

        // Check if user account is active
        if (!$user->isActive()) {
            auth()->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('staff.login')->with('error', 'Your staff account is inactive. Please contact the administrator.');
        }

        // Check if user has specific permission
        if (!$user->hasAdminPermission($permission)) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Access denied. You do not have permission to access the ' . ucfirst(str_replace('_', ' ', $permission)) . ' section.'
                ], 403);
            }

            return response()->view('errors.403', [
                'permission' => ucfirst(str_replace('_', ' ', $permission)),
                'raw_permission' => $permission,
            ], 403);
        }

        return $next($request);
    }
}
