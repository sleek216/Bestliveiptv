<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class EmployeeController extends Controller
{
    /**
     * Permission dictionary organized by category for clean presentation
     */
    public static function getPermissionsConfig(): array
    {
        return [
            'Core Modules' => [
                'dashboard' => [
                    'label' => 'Dashboard Overview',
                    'desc' => 'View operational summary, revenue metrics, and high-level KPIs',
                    'icon' => 'bi-speedometer2',
                ],
                'orders' => [
                    'label' => 'Orders Management',
                    'desc' => 'View, process, edit, status update, and print invoices for customer orders',
                    'icon' => 'bi-cart3',
                ],
                'packages' => [
                    'label' => 'Services & Packages',
                    'desc' => 'Create, edit, price adjustment, and manage service plans and packages',
                    'icon' => 'bi-box-seam',
                ],
                'users' => [
                    'label' => 'Customers / Users',
                    'desc' => 'View customer accounts, details, order history, and reset credentials',
                    'icon' => 'bi-people',
                ],
            ],
            'Marketing & Engagement' => [
                'coupons' => [
                    'label' => 'Coupons & Discounts',
                    'desc' => 'Create discount codes, set percentage/fixed limits, and expiration rules',
                    'icon' => 'bi-tag',
                ],
                'announcement' => [
                    'label' => 'Announcement Banner',
                    'desc' => 'Update site-wide top marquee/alert bar text and call-to-actions',
                    'icon' => 'bi-megaphone',
                ],
                'blogs' => [
                    'label' => 'Blog Management',
                    'desc' => 'Author, edit, publish, and manage SEO blog posts and articles',
                    'icon' => 'bi-journal-text',
                ],
                'contacts' => [
                    'label' => 'Support / Contact Inquiries',
                    'desc' => 'Review customer support messages, inquiry details, and mark status',
                    'icon' => 'bi-envelope-fill',
                ],
                'countries' => [
                    'label' => 'Countries Management',
                    'desc' => 'Manage available countries, regional lists, and active status',
                    'icon' => 'bi-globe',
                ],
            ],
            'Affiliate Program' => [
                'affiliate_overview' => [
                    'label' => 'Affiliate Overview',
                    'desc' => 'Access affiliate dashboard metrics, conversion ratios, and volume charts',
                    'icon' => 'bi-graph-up',
                ],
                'affiliate_affiliates' => [
                    'label' => 'Affiliate Users',
                    'desc' => 'View referred user accounts and manage custom commission rates',
                    'icon' => 'bi-person-plus',
                ],
                'affiliate_referrals' => [
                    'label' => 'Referral Tracking',
                    'desc' => 'Inspect referral links, tracking visits, and registration attribution',
                    'icon' => 'bi-link-45deg',
                ],
                'affiliate_commissions' => [
                    'label' => 'Commissions',
                    'desc' => 'Review, approve, manually adjust, or reject affiliate sales earnings',
                    'icon' => 'bi-cash-coin',
                ],
                'affiliate_payouts' => [
                    'label' => 'Affiliate Payouts',
                    'desc' => 'Review payout withdrawal requests, complete transfers, and log proof',
                    'icon' => 'bi-wallet2',
                ],
                'affiliate_settings' => [
                    'label' => 'Affiliate Program Settings',
                    'desc' => 'Configure default commission percentage, cookie expiration, and terms',
                    'icon' => 'bi-sliders',
                ],
            ],
            'Settings & Infrastructure' => [
                'settings_general' => [
                    'label' => 'General Settings',
                    'desc' => 'WhatsApp support numbers, Crisp chat ID, and site configuration',
                    'icon' => 'bi-gear',
                ],
                'settings_stripe' => [
                    'label' => 'Stripe Gateway',
                    'desc' => 'View and configure live/test API keys and webhook secrets',
                    'icon' => 'bi-credit-card',
                ],
                'settings_nowpayments' => [
                    'label' => 'NOWPayments Crypto',
                    'desc' => 'Configure cryptocurrency payment gateway API and IPN keys',
                    'icon' => 'bi-currency-bitcoin',
                ],
                'settings_email' => [
                    'label' => 'SMTP / Email Configuration',
                    'desc' => 'Configure mail server credentials and dispatch test emails',
                    'icon' => 'bi-envelope',
                ],
                'settings_security' => [
                    'label' => 'Security & 2FA',
                    'desc' => 'Manage two-factor authentication requirements and system policies',
                    'icon' => 'bi-shield-lock',
                ],
                'export_backup' => [
                    'label' => 'System Backup & Export',
                    'desc' => 'Download complete system customer and transaction data backup CSV',
                    'icon' => 'bi-file-earmark-spreadsheet',
                ],
                'manage_employees' => [
                    'label' => 'Manage Staff & Employees',
                    'desc' => 'Invite, edit permissions, and manage other staff members',
                    'icon' => 'bi-person-badge',
                ],
            ],
        ];
    }

    /**
     * Display a listing of employees
     */
    public function index(Request $request): View
    {
        $query = User::where('is_admin', true)
            ->where(function ($q) {
                $q->where('is_super_admin', false)
                  ->orWhereNull('is_super_admin');
            });

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('designation', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->where('is_active', true);
            } elseif ($request->status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        $employees = $query->latest()->paginate(15);

        $totalEmployees = User::where('is_admin', true)
            ->where(function ($q) {
                $q->where('is_super_admin', false)
                  ->orWhereNull('is_super_admin');
            })->count();

        $activeEmployees = User::where('is_admin', true)
            ->where(function ($q) {
                $q->where('is_super_admin', false)
                  ->orWhereNull('is_super_admin');
            })
            ->where('is_active', true)
            ->count();

        $staffLoginUrl = url('/staff/login');
        $permissionGroups = self::getPermissionsConfig();

        return view('admin.employees.index', compact(
            'employees',
            'totalEmployees',
            'activeEmployees',
            'staffLoginUrl',
            'permissionGroups'
        ));
    }

    /**
     * Show form to add a new employee
     */
    public function create(): View
    {
        $permissionGroups = self::getPermissionsConfig();
        return view('admin.employees.create', compact('permissionGroups'));
    }

    /**
     * Store a newly created employee in storage
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'designation' => 'nullable|string|max:100',
            'phone' => 'nullable|string|max:50',
            'password' => ['required', 'confirmed', Password::min(8)],
            'is_active' => 'nullable|boolean',
            'permissions' => 'nullable|array',
            'permissions.*' => 'string',
        ]);

        $employee = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'designation' => $validated['designation'] ?? 'Staff Member',
            'phone' => $validated['phone'] ?? null,
            'password' => Hash::make($validated['password']),
            'is_admin' => true,
            'is_super_admin' => false,
            'is_active' => $request->boolean('is_active', true),
            'admin_permissions' => $request->input('permissions', []),
        ]);

        return redirect()
            ->route('admin.employees.index')
            ->with('success', "Employee {$employee->name} added successfully! Share the Staff Portal URL with them.");
    }

    /**
     * Show the form for editing an employee
     */
    public function edit(User $employee): View|RedirectResponse
    {
        // Prevent editing super admin from here
        if ($employee->isSuperAdmin()) {
            return redirect()
                ->route('admin.employees.index')
                ->with('error', 'Super Administrator accounts cannot be modified via staff management.');
        }

        $permissionGroups = self::getPermissionsConfig();
        $assignedPermissions = $employee->admin_permissions ?? [];

        return view('admin.employees.edit', compact('employee', 'permissionGroups', 'assignedPermissions'));
    }

    /**
     * Update employee profile and permissions
     */
    public function update(Request $request, User $employee): RedirectResponse
    {
        if ($employee->isSuperAdmin()) {
            return redirect()
                ->route('admin.employees.index')
                ->with('error', 'Super Administrator accounts cannot be modified via staff management.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $employee->id,
            'designation' => 'nullable|string|max:100',
            'phone' => 'nullable|string|max:50',
            'password' => ['nullable', 'confirmed', Password::min(8)],
            'is_active' => 'nullable|boolean',
            'permissions' => 'nullable|array',
            'permissions.*' => 'string',
        ]);

        $updateData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'designation' => $validated['designation'] ?? 'Staff Member',
            'phone' => $validated['phone'] ?? null,
            'is_admin' => true,
            'is_active' => $request->boolean('is_active', true),
            'admin_permissions' => $request->input('permissions', []),
        ];

        if (!empty($validated['password'])) {
            $updateData['password'] = Hash::make($validated['password']);
        }

        $employee->update($updateData);

        return redirect()
            ->route('admin.employees.index')
            ->with('success', "Employee {$employee->name}'s privileges and profile updated successfully!");
    }

    /**
     * Quick status toggle (Active / Suspended)
     */
    public function toggleStatus(User $employee): RedirectResponse
    {
        if ($employee->id === auth()->id()) {
            return back()->with('error', 'You cannot change your own active status.');
        }

        if ($employee->isSuperAdmin()) {
            return back()->with('error', 'Super Administrator status cannot be toggled.');
        }

        $newStatus = !$employee->isActive();
        $employee->update(['is_active' => $newStatus]);

        $statusText = $newStatus ? 'activated' : 'suspended';
        return back()->with('success', "Employee {$employee->name} has been {$statusText}.");
    }

    /**
     * Quick password reset
     */
    public function resetPassword(Request $request, User $employee): RedirectResponse
    {
        if ($employee->isSuperAdmin() && !auth()->user()->isSuperAdmin()) {
            return back()->with('error', 'Unauthorized action.');
        }

        $validated = $request->validate([
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $employee->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('success', "Password for {$employee->name} has been reset successfully!");
    }

    /**
     * Remove employee account
     */
    public function destroy(User $employee): RedirectResponse
    {
        if ($employee->id === auth()->id()) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        if ($employee->isSuperAdmin()) {
            return back()->with('error', 'Super Administrator accounts cannot be deleted.');
        }

        $name = $employee->name;
        $employee->delete();

        return redirect()
            ->route('admin.employees.index')
            ->with('success', "Employee {$name} removed successfully.");
    }
}
