<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('admin.layout', function ($view) {
            $view->with('unreadCount', \App\Models\ContactEnquiry::whereNull('read_at')->count());
        });

        View::composer('*', function ($view) {
            $admin = \App\Models\User::where('role', 'admin')->first();
            $view->with('siteWhatsapp', $admin->whatsapp_number ?? '');
            $view->with('siteNotificationEmail', $admin->notification_email ?? '');
        });
    }
}
