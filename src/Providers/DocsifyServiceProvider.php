<?php

namespace JannisMilz\Docsify\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use JannisMilz\Docsify\Commands\GenerateDocumentationCommand;
use JannisMilz\Docsify\Commands\InstallCommand;
use JannisMilz\Docsify\Facades\Docsify;

class DocsifyServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'docsify');

        $routesConfig =  [
            'prefix'     => config('docsify.docs.route'),
            'namespace'  => 'JannisMilz\Docsify\Http\Controllers',
            'as'         => 'docsify.',
            // 'middleware' => config('docsify.docs.middleware'),
        ];

        Route::group($routesConfig, function () {
            $this->loadRoutesFrom(__DIR__ . '/../../routes/Docsify.php');
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/docsify.php', 'docsify');

        if ($this->app->runningInConsole()) {
            $this->registerPublishableResources();

            $this->commands([
                InstallCommand::class,
                GenerateDocumentationCommand::class
            ]);
        }

        // $this->app->bind(MarkdownParser::class, ParseDownMarkdownParser::class);

        $this->app->alias('Docsify', Docsify::class);

        $this->app->singleton('Docsify', function () {
            return new Docsify();
        });
    }

    /**
     * Register the publishable files.
     */
    protected function registerPublishableResources()
    {
        $publishable = [
            'docsify_config' => [
                __DIR__ . "/../../config/docsify.php" => config_path('docsify.php'),
            ],
            'docsify_assets' => [
                __DIR__ . "/../../public/assets/" => public_path('vendor/jannismilz/laravel-docsify/assets'),
            ],
        ];

        foreach ($publishable as $group => $paths) {
            $this->publishes($paths, $group);
        }
    }
}
