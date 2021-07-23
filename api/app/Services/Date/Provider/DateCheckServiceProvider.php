<?php

namespace App\Services\Date\Provider;

use App\Services\Date\DateCheck;
use Illuminate\Support\ServiceProvider;

class DateCheckServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('dateCheck', DateCheck::class);
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
