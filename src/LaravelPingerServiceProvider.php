<?php

namespace Gaaarfild\LaravelPinger;

use Illuminate\Support\ServiceProvider;

class LaravelPingerServiceProvider extends ServiceProvider
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
        $this->registerLaravelPinger();
        $this->app->alias('pinger', \Gaaarfild\LaravelPinger\Pinger::class);
    }

    private function registerLaravelPinger()
    {
        $this->app->bindShared('pinger', function ($app) {
            return new Pinger();
        });
    }
}
