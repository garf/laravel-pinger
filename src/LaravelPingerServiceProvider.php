<?php

namespace Garf\LaravelPinger;

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
        $this->loadViewsFrom(__DIR__.'/views', 'laravel-pinger');
        $this->publishes([
            __DIR__.'/config/config.php' => config_path('pinger.php'),
        ], 'config');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerLaravelPinger();
        $this->app->alias('pinger', \Garf\LaravelPinger\Pinger::class);
        $this->mergeConfigFrom(
            __DIR__.'/config/config.php', 'pinger'
        );
    }

    private function registerLaravelPinger()
    {
        $this->app->singleton('pinger', function ($app) {
            return new Pinger();
        });
    }
}
