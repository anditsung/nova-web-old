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
        $this->publishes([
            __DIR__.'/../../config/nova.php' => config_path('nova.php'),
        ], 'novaweb-config');

        $this->publishes([
            __DIR__.'/../../resources' => resource_path(''),
        ], 'novaweb-resources');

//        $this->publishes([
//            __DIR__.'/../../resources/views' => resource_path('views'),
//        ], 'novaweb-views');
//
//        $this->publishes([
//            __DIR__.'/../../resources/fonts' => resource_path('fonts'),
//        ], 'novaweb-fonts');

        $this->publishes([
            __DIR__.'/../../config/tailwind.config.js' => base_path('tailwind.config.js'),
        ], 'novaweb-tailwind');

        $this->publishes([
            __DIR__.'/../../config/webpack.mix.js' => base_path('webpack.mix.js'),
        ], 'novaweb-webpack');
    }
}
