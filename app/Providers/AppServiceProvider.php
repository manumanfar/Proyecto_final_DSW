<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        if (request()->server->has('HTTP_X_ORIGINAL_HOST')) {

            request()->server->set('HTTP_HOST', request()->server->get('HTTP_X_ORIGINAL_HOST'));

            request()->headers->set('HOST', request()->server->get('HTTP_X_ORIGINAL_HOST'));
        }

        Paginator::useBootstrap();

    }
}
