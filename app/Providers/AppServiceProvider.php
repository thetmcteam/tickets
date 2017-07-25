<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Schema::defaultStringLength(191);
    }

    public function register()
    {
        foreach ($this->app['config']['repositories'] as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
    }
}
