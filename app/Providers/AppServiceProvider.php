<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\{Permission};
use App\Observers\{PermissionObserver};

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
        Paginator::useBootstrapFive();

        /* Observers */
        Permission::observe(PermissionObserver::class);

        /* Do not Change */
        if(env('APP_ENV') === 'production'){
            \URL::forceScheme('https');
        }
    }
}
