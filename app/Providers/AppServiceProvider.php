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

            if (\Illuminate\Support\Facades\Schema::hasTable('countries') && \Illuminate\Support\Facades\Schema::hasTable('states')) {
                $globalCountries = \Illuminate\Support\Facades\Cache::rememberForever('global_countries', function () {
                    return \App\Models\Country::where('status', 1)->get();
                });
                $globalStates = \Illuminate\Support\Facades\Cache::rememberForever('global_states', function () {
                    return \App\Models\State::where('status', 1)->get();
                });
                
                \Illuminate\Support\Facades\View::share('globalCountries', $globalCountries);
                \Illuminate\Support\Facades\View::share('globalStates', $globalStates);
            }
        } catch (\Exception $e) {
            // Do nothing if db fails
        }
    }
}
