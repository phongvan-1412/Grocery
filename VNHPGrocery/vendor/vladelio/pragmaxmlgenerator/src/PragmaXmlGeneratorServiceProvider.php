<?php

namespace Vladelio\PragmaXmlGenerator;

use Illuminate\Support\ServiceProvider;

class PragmaXmlGeneratorServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
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
        $this->mergeConfigFrom(__DIR__.'/../config/pragmaxmlgenerator.php', 'pragmaxmlgenerator');
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
            __DIR__.'/../config/pragmaxmlgenerator.php' => config_path('pragmaxmlgenerator.php'),
        ], 'pragmaxmlgenerator.config');
    }
}
