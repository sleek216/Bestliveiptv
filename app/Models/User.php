<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'country',
        'designation',
        'is_admin',
        'is_active',
        'last_login_at',
        'referred_by',
        'referral_code',
        'google2fa_secret',
        'google2fa_enabled',
        'is_super_admin',
        'admin_permissions',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
            'is_active' => 'boolean',
            'last_login_at' => 'datetime',
            'google2fa_enabled' => 'boolean',
            'google2fa_secret' => 'encrypted',
            'is_super_admin' => 'boolean',
            'admin_permissions' => 'array',
        ];
    }

    /**
     * Check if user is admin
     */
    public function isAdmin(): bool
    {
        return $this->is_admin === true;
    }

    /**
     * Check if user is super admin
     */
    public function isSuperAdmin(): bool
    {
        return $this->is_super_admin === true;
    }

    /**
     * Check if user is an employee / staff member
     */
    public function isEmployee(): bool
    {
        return $this->isAdmin() && !$this->isSuperAdmin();
    }

    /**
     * Check if user account is active
     */
    public function isActive(): bool
    {
        return $this->is_active !== false;
    }

    /**
     * Get the first permitted admin route for redirection upon login
     */
    public function getFirstPermittedAdminRoute(): string
    {
        if ($this->isSuperAdmin()) {
            return 'admin.dashboard';
        }

        $routesMap = [
            'dashboard' => 'admin.dashboard',
            'orders' => 'admin.orders.index',
            'packages' => 'admin.packages.index',
            'users' => 'admin.users.index',
            'contacts' => 'admin.contacts.index',
            'coupons' => 'admin.coupons.index',
            'blogs' => 'admin.blogs.index',
            'announcement' => 'admin.announcement.index',
            'countries' => 'admin.countries.index',
            'affiliate_overview' => 'admin.affiliate.index',
            'affiliate_affiliates' => 'admin.affiliate.affiliates',
            'affiliate_referrals' => 'admin.affiliate.referrals',
            'affiliate_commissions' => 'admin.affiliate.commissions',
            'affiliate_payouts' => 'admin.affiliate.payouts',
            'affiliate_settings' => 'admin.affiliate.settings',
            'settings_general' => 'admin.settings.index',
            'settings_stripe' => 'admin.settings.stripe',
            'settings_nowpayments' => 'admin.settings.nowpayments',
            'settings_email' => 'admin.settings.email',
            'settings_security' => 'admin.security.index',
            'manage_employees' => 'admin.employees.index',
        ];

        foreach ($routesMap as $permission => $routeName) {
            if ($this->hasAdminPermission($permission)) {
                return $routeName;
            }
        }

        return 'admin.dashboard';
    }

    /**
     * Check if user has specific admin permission
     */
    public function hasAdminPermission(string $permission): bool
    {
        if ($this->isSuperAdmin()) {
            return true;
        }

        $permissions = $this->admin_permissions ?? [];

        if (in_array($permission, $permissions, true)) {
            return true;
        }

        // Routes use umbrella keys (e.g. "affiliate") while the UI uses granular keys.
        if ($permission === 'affiliate') {
            return $this->hasAnyPermissionPrefix($permissions, 'affiliate_');
        }

        if (str_starts_with($permission, 'affiliate_') && in_array('affiliate', $permissions, true)) {
            return true;
        }

        if ($permission === 'settings') {
            return $this->hasAnyPermissionPrefix($permissions, 'settings_');
        }

        if (str_starts_with($permission, 'settings_') && in_array('settings', $permissions, true)) {
            return true;
        }

        return false;
    }

    /**
     * Check if user has any of the given admin permissions
     */
    public function hasAnyAdminPermission(array $permissions): bool
    {
        if ($this->isSuperAdmin()) {
            return true;
        }

        foreach ($permissions as $permission) {
            if ($this->hasAdminPermission($permission)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param  array<int, string>  $permissions
     */
    private function hasAnyPermissionPrefix(array $permissions, string $prefix): bool
    {
        foreach ($permissions as $granted) {
            if (str_starts_with($granted, $prefix)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Get user's orders
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Get user's active subscription
     */
    public function activeSubscription()
    {
        return $this->orders()
            ->where('order_status', 'completed')
            ->where('payment_status', 'completed')
            ->where(function($query) {
                $query->whereNull('expires_at')
                      ->orWhere('expires_at', '>', now());
            })
            ->latest()
            ->first();
    }

    /**
     * Check if user has active subscription
     */
    public function hasActiveSubscription(): bool
    {
        return $this->activeSubscription() !== null;
    }

    /**
     * Get user's affiliate account
     */
    public function affiliate()
    {
        return $this->hasOne(Affiliate::class);
    }

    /**
     * Get user who referred this user
     */
    public function referrer()
    {
        return $this->belongsTo(User::class, 'referred_by');
    }

    /**
     * Get users referred by this user
     */
    public function referredUsers()
    {
        return $this->hasMany(User::class, 'referred_by');
    }

    /**
     * Create affiliate account for user
     */
    public function createAffiliateAccount(): Affiliate
    {
        if ($this->affiliate) {
            return $this->affiliate;
        }

        return Affiliate::create([
            'user_id' => $this->id,
            'referral_code' => Affiliate::generateReferralCode(),
        ]);
    }

    /**
     * Get referral link
     */
    public function getReferralLinkAttribute(): string
    {
        if (!$this->affiliate) {
            return '';
        }

        return rtrim(url('/'), '/') . '/?ref=' . $this->affiliate->referral_code;
    }
}

