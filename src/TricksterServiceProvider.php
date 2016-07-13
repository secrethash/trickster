<?php

namespace Secrethash\Trickster;

use Illuminate\Support\ServiceProvider;

class TricksterServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // loading the routes
        // require __DIR__ . "/Http/routes.php";
        $configPath = __DIR__ . '/config/trickster.php';
        $this->publishes([$configPath => config_path('trickster.php')]);
        $this->mergeConfigFrom($configPath, 'trickster');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('Secrethash\Trickster\Trickster');

        $this->bindFacade();

    }

    private function bindFacade() {
        $this->app->bind('trickster', function($app) {
            return new Trickster();
        });
    }

}
