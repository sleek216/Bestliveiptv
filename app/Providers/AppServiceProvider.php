<?php

namespace App\Providers;

use App\Models\Contact;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            if (
                !Auth::check() ||
                !Schema::hasTable('orders') ||
                !Schema::hasColumn('orders', 'admin_seen_at') ||
                !Schema::hasColumn('orders', 'user_seen_at')
            ) {
                return;
            }

            $user = Auth::user();

            if ($user->isAdmin()) {
                $view->with('adminUnreadOrdersCount', Order::whereNull('admin_seen_at')->count());
                $view->with(
                    'adminUnreadContactsCount',
                    Contact::query()->when(
                        Schema::hasColumn('contacts', 'admin_seen_at'),
                        fn ($query) => $query->whereNull('admin_seen_at'),
                        fn ($query) => $query->where('status', 'new')
                    )->count()
                );
                $view->with(
                    'adminUnreadUsersCount',
                    Schema::hasColumn('users', 'admin_seen_at')
                        ? User::where('is_admin', false)->whereNull('admin_seen_at')->count()
                        : 0
                );
                return;
            }

            $view->with(
                'userUnreadOrdersCount',
                Order::where('user_id', $user->id)->whereNull('user_seen_at')->count()
            );
        });

        if (\Illuminate\Support\Facades\Schema::hasTable('settings')) {
            // Load email settings
            if ($mailHost = \App\Models\Setting::get('mail_host')) {
                config(['mail.mailers.smtp.host' => $mailHost]);
            }
            if ($mailPort = \App\Models\Setting::get('mail_port')) {
                config(['mail.mailers.smtp.port' => $mailPort]);
            }
            if ($mailUsername = \App\Models\Setting::get('mail_username')) {
                config(['mail.mailers.smtp.username' => $mailUsername]);
            }
            if ($mailPassword = \App\Models\Setting::get('mail_password')) {
                config(['mail.mailers.smtp.password' => $mailPassword]);
            }
            if ($mailEncryption = \App\Models\Setting::get('mail_encryption')) {
                config(['mail.mailers.smtp.encryption' => $mailEncryption]);
            }
            if ($mailFromAddress = \App\Models\Setting::get('mail_from_address')) {
                config(['mail.from.address' => $mailFromAddress]);
            }
            if ($mailFromName = \App\Models\Setting::get('mail_from_name')) {
                config(['mail.from.name' => $mailFromName]);
            }

            // Load Stripe settings
            if ($stripeKey = \App\Models\Setting::get('stripe_publishable_key')) {
                config(['services.stripe.key' => $stripeKey]);
            }
            if ($stripeSecret = \App\Models\Setting::get('stripe_secret_key')) {
                config(['services.stripe.secret' => $stripeSecret]);
            }
            if ($stripeWebhook = \App\Models\Setting::get('stripe_webhook_secret')) {
                config(['services.stripe.webhook.secret' => $stripeWebhook]);
            }

            // Load NOWPayments settings
            if ($nowPaymentKey = \App\Models\Setting::get('nowpayments_api_key')) {
                config(['services.nowpayments.api_key' => $nowPaymentKey]);
            }
            if ($nowPaymentSecret = \App\Models\Setting::get('nowpayments_ipn_secret')) {
                config(['services.nowpayments.ipn_secret' => $nowPaymentSecret]);
            }
            if ($nowPaymentEnv = \App\Models\Setting::get('nowpayments_sandbox')) {
                config(['services.nowpayments.sandbox' => $nowPaymentEnv]);
            }
        }
    }
}
