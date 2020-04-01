<?php

namespace Anditsung\NovaWeb\Providers;

use Anditsung\NovaWeb\Console\InstallCommand;
use Anditsung\NovaWeb\Console\PublishCommand;
use Illuminate\Support\ServiceProvider;

class NovaWebServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->commands([
            InstallCommand::class,
            PublishCommand::class,
        ]);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->registerPublishing();
        }
    }

    protected function registerPublishing()
    {
        /* CONFIG */
        $this->publishes([
            __DIR__.'/../../config/nova.php' => config_path('nova.php'),
        ], 'novaweb-config');

        $this->publishes([
            __DIR__.'/../../config/tailwind.nova.js' => base_path('tailwind.js'),
        ], 'novaweb-novatailwind');

        $this->publishes([
            __DIR__.'/../../config/css/nova.css' => resource_path('css/app.css')
        ], 'novaweb-cssnovatailwind');

        $this->publishes([
            __DIR__.'/../../config/tailwind.config.js' => base_path('tailwind.js'),
        ], 'novaweb-tailwind');

        $this->publishes([
            __DIR__.'/../../config/css/tailwind.css' => resource_path('css/app.css')
        ], 'novaweb-csstailwind');

        $this->publishes([
            __DIR__.'/../../config/webpack.mix.js' => base_path('webpack.mix.js'),
        ], 'novaweb-webpack');

        /* RESOURCES */
        $this->publishes([
            __DIR__.'/../../resources' => resource_path(''),
        ], 'novaweb-resources');
    }
}
