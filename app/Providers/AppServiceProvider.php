<?php

namespace App\Providers;

use Illuminate\Support\Optional;
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
        Optional::macro('getValue', function() {
            return $this->value;
        });
    }
}
