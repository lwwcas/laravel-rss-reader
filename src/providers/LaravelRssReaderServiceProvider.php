<?php

namespace Lwwcas\LaravelRssReader\Providers;

use Illuminate\Support\ServiceProvider;
use Lwwcas\LaravelRssReader\LaravelRssReader;

class LaravelRssReaderServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'laravel-rss-reader');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'laravel-rss-reader');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');
        // $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('laravel-rss-reader.php'),
            ], 'laravel-rss-reader-config');

            // Publishing the migrations.
            // $this->publishes([
            //     __DIR__ . '/../database/migrations' => database_path('migrations'),
            // ], 'laravel-rss-reader-migrations');

            // Publishing the seeds.
            // $this->publishes([
            //     __DIR__ . '/../database/seeders' => database_path('seeders/LwwcasLaravelRssReader'),
            // ], 'laravel-rss-reader-seeds');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/laravel-rss-reader'),
            ], 'views');*/

            // Publishing assets.
            // $this->publishes([
            //     __DIR__ . '/../resources/assets' => public_path('vendor/laravel-rss-reader'),
            // ], 'assets');

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/laravel-rss-reader'),
            ], 'lang');*/

            // Registering package commands.
            // $this->commands([]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'laravel-rss-reader');

        // Register the main class to use with the facade
        $this->app->singleton('laravel-rss-reader', function () {
            return new LaravelRssReader();
        });
    }
}
