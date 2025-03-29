<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\User1Service;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(User1Service::class, function ($app) {
            return new User1Service();
        });
        
    }
}

