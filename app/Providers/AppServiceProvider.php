<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        \Illuminate\Support\Facades\Blade::if('hasPermission', function ($module, $action = 'view') {
            $user = auth()->user();
            if (!$user) return false;
            
            return $user->hasPermissionTo($module, $action);
        });
    }
}
