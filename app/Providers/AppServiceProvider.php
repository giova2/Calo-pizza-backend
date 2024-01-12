<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Pagination\Paginator;

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
    public function boot(UrlGenerator $url):void
    {
        // Schema::defaultStringLength(191);
        if (config('app.env') !== 'local') { //env('APP_ENV') !== 'local'
            $url->forceScheme('https');
        }

        Paginator::defaultView('vendor.pagination.tailwind');
 
        Paginator::defaultSimpleView('vendor.pagination.tailwind');

    }
}
