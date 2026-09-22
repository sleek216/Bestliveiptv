<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class StaffAuthController extends Controller
{
    /**
     * Show the dedicated staff & employee login portal
     */
    public function showLogin(): View|RedirectResponse
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->isAdmin()) {
                return redirect()->route($user->getFirstPermittedAdminRoute());
            }
            return redirect()->route('home');
        }

        return view('auth.staff-login');
    }

    /**
     * Authenticate employee credentials
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (!Auth::validate($credentials)) {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our staff records.',
            ])->onlyInput('email');
        }

        $user = User::where('email', $credentials['email'])->first();

        // Strictly verify staff privilege
        if (!$user || !$user->isAdmin()) {
            return back()->withErrors([
                'email' => 'Access denied. This portal is strictly reserved for authorized staff & employees.',
            ])->onlyInput('email');
        }

        // Verify account active status
        if (!$user->isActive()) {
            return back()->withErrors([
                'email' => 'Your staff account has been deactivated. Please contact your administrator.',
            ])->onlyInput('email');
        }

        // Check 2FA
        if ($user->google2fa_enabled) {
            session()->put([
                '2fa_user_id' => $user->id,
                '2fa_remember' => $request->boolean('remember'),
            ]);

            return redirect()->route('2fa.show');
        }

        Auth::login($user, $request->boolean('remember'));
        $request->session()->regenerate();

        // Update last login timestamp
        $user->update(['last_login_at' => now()]);

        // Redirect directly to first permitted section
        $targetRoute = $user->getFirstPermittedAdminRoute();

        return redirect()->intended(route($targetRoute))
            ->with('success', 'Welcome back, ' . $user->name . '!');
    }

    /**
     * Staff logout action
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('staff.login')->with('success', 'You have been safely logged out of the staff portal.');
    }
}
