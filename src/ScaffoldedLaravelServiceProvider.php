<?php

namespace Khantnyar\ScaffoldedLaravel;

use Khantnyar\ScaffoldedLaravel\Console\Commands\MakeApiControllerCommand;
use Khantnyar\ScaffoldedLaravel\Console\Commands\InstallCommand;
use Illuminate\Support\ServiceProvider;

class ScaffoldedLaravelServiceProvider extends ServiceProvider
{
    protected $vendor   = 'Khantnyar';
    protected $package  = 'ScaffoldedLaravel';
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->publisherConfigs();

        if ($this->app->runningInConsole()) {
            $this->registerCommands();
        }
        $this->registerRoutes();
        // $this->registerRoutes();
        $this->registerViews();
        // $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        // $this->loadRoutesFrom(__DIR__ . '/routes/api.php');

        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'scaffolded-laravel');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'scaffolded-laravel');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');


        // if ($this->app->runningInConsole()) {
        //     $this->publishes([
        //         __DIR__ . '/../config/config.php' => config_path('scaffolded-laravel.php'),
        //     ], 'config');

        // Publishing the views.
        /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/scaffolded-laravel'),
            ], 'views');*/

        // Publishing assets.
        /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/scaffolded-laravel'),
            ], 'assets');*/

        // Publishing the translation files.
        /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/scaffolded-laravel'),
            ], 'lang');*/

        // Registering package commands.
        // $this->commands([]);
        // }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->bind($this->package, function ($app) {
            return new $this->package;
        });
        // $this->app->make('Khantnyar/ScaffoldedLaravel/ScaffoldedLaravel');
        // Automatically apply the package configuration
        // $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'scaffolded-laravel');

        // // Register the main class to use with the facade
        // $this->app->singleton('scaffolded-laravel', function () {
        //     return new ScaffoldedLaravel;
        // });
    }


    /**
     * publishing the application config
     */
    protected function publisherConfigs()
    {
        // $this->publishes([
        //     __DIR__ . '/../config/courier.php' => config_path('courier.php'),
        // ]);
        // $this->mergeConfigFrom(
        //     __DIR__ . '/../config/courier.php',
        //     'courier'
        // );
    }

    /**
     * Register the application Route.
     */
    protected function registerRoutes()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadRoutesFrom(__DIR__ . '/routes/api.php');
    }

    /**
     * Register the application Migrations.
     */
    protected function registerMigrations()
    {
        // $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }
    /**
     * Register the application Views.
     */
    protected function registerViews()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'scaffolded-laravel');
        // $this->publishes([
        //     __DIR__ . '/../resources/views' => resource_path('views/vendor/courier'),
        // ]);
    }


    protected function registerCommands()
    {
        $this->commands([
            InstallCommand::class,
            MakeApiControllerCommand::class
        ]);
    }
}
