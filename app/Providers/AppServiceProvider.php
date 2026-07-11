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
        \Illuminate\Pagination\Paginator::useBootstrapFive();

        \Illuminate\Support\Facades\Blade::if('hasPermission', function ($module, $action = 'view') {
            $user = auth()->user();
            if (!$user) return false;
            
            return $user->hasPermissionTo($module, $action);
        });

        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('settings')) {
                \Illuminate\Support\Facades\View::share('settings', \App\Models\Setting::pluck('value', 'key'));
            }
        } catch (\Exception $e) {
            // Do nothing if db fails
        }
    }
}
