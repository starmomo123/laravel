<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\TestService;
use App\Services\TimeHandleService;

class TestServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('test',function(){
            return new TestService();
        });

    }
}
