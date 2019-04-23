<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class makeRandomStrServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('makeRandomStr', function (){
            return new \App\Services\MakeRandomStr;
        });
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
