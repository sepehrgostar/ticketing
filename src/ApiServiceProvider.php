<?php

namespace Sepehrgostar\Api;

use Illuminate\Support\ServiceProvider;

class ApiServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        //$this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'sepehrgostar');
         $this->loadViewsFrom(__DIR__.'/resources/views', 'sepehrgostar');
         $this->loadRoutesFrom(__DIR__.'/routes/web.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/config/api.php', 'api');

        // Register the service the package provides.
        $this->app->singleton('api', function ($app) {
            return new Api;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['api'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/config/api.php' => config_path('api.php'),
        ], 'api.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/sepehrgostar'),
        ], 'api.views');*/

        // Publishing assets.
        $this->publishes([
            __DIR__.'/resources/assets' => public_path('vendor/sepehrgostar'),
        ], 'sepehrgostar.api.views');

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/sepehrgostar'),
        ], 'api.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
