<?php

namespace App\Providers;

use App\Extensions\TokenUserProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

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
        Auth::provider('token-driver', function ($app, array $config) {
            return new TokenUserProvider($app['hash'], $config['model']);
        });
    }
}
