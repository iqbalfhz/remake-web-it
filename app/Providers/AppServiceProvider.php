<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Super admin (is_admin flag) bypasses all Gate checks
        Gate::before(function ($user, $ability) {
            if ($user->is_admin) {
                return true;
            }
        });
    }
}
