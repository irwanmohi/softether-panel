<?php

namespace App\Providers;

use App\Services\Concerns\Link;
use Illuminate\Support\ServiceProvider;
use App\Contracts\Concerns\Link as LinkContract;

class ConcernServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            LinkContract::class,
            Link::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
