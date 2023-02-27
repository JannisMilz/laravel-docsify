<?php

namespace JannisMilz\Docsify;

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
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'docsify');

        Route::group($this->routesConfig(), function () {
            $this->loadRoutesFrom(__DIR__ . '/../routes/Docsify.php');
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerConfigs();

        if ($this->app->runningInConsole()) {
            $this->registerPublishableResources();
            $this->registerConsoleCommands();
        }

        // $this->app->bind(MarkdownParser::class, ParseDownMarkdownParser::class);

        $this->app->alias('Docsify', Docsify::class);

        $this->app->singleton('Docsify', function () {
            return new Docsify();
        });
    }

    /**
     * @return array
     */
    protected function routesConfig()
    {
        return [
            'prefix'     => config('docsify.docs.route'),
            'namespace'  => 'JannisMilz\Docsify\Http\Controllers',
            'as'         => 'docsify.',
            // 'middleware' => config('docsify.docs.middleware'),
        ];
    }

    /**
     * Register the publishable files.
     */
    protected function registerPublishableResources()
    {
        $publishable = [
            'docsify_config' => [
                dirname(__DIR__) . "/config/docsify.php" => config_path('docsify.php'),
            ],
            'assets' => [
                __DIR__ . "/../resources/assets/" => public_path('docsify'),
            ],
            'views' => [
                __DIR__ . "/../resources/views" => resource_path('views/vendor/docsify'),
            ],
        ];

        foreach ($publishable as $group => $paths) {
            $this->publishes($paths, $group);
        }
    }

    /**
     * Register the commands accessible from the Console.
     */
    protected function registerConsoleCommands()
    {
        $this->commands(InstallCommand::class);
        $this->commands(GenerateDocumentationCommand::class);
    }

    /**
     * Register the package configs.
     */
    protected function registerConfigs()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/docsify.php', 'docsify');
    }
}
