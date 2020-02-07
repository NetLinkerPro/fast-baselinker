<?php

namespace NetLinker\FastBaselinker;

use Illuminate\Support\ServiceProvider;

class FastBaselinkerServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'fast-baselinker');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'fast-baselinker');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

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
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/fast-baselinker.php', 'fast-baselinker');

        // Register the service the package provides.
        $this->app->singleton('fast-baselinker', function ($app) {
            return new FastBaselinker();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['fast-baselinker'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {

        // Publishing the configuration file.
        $this->publishes([
            __DIR__ . '/../config/fast-baselinker.php' => config_path('fast-baselinker.php'),
        ], 'config');

        // Publishing the views.
        $this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/fast-baselinker'),
        ], 'views');

        // Publishing assets.
        $this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/fast-baselinker'),
        ], 'views');

        // Publishing the translation files.
        $this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/fast-baselinker'),
        ], 'views');

        // Registering package commands.
        $this->commands([]);
    }

}
