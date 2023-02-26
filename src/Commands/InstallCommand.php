<?php

namespace JannisMilz\Docsify\Commands;

use Illuminate\Console\Command;
use JannisMilz\Docsify\DocsifyServiceProvider;
use Symfony\Component\Process\Process;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'docsify:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish the required assets and configurations.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->line('📖 Publishing assets and congigurations.. ');
        $this->call('vendor:publish', ['--provider' => DocsifyServiceProvider::class, '--tag' => ['docsify_config', 'assets', 'views']]);

        $this->line('📖 Setup initial documentation structure under ' . config('docsify.docs.path') . '.. ');
        $this->call('docsify:generate');

        $this->line('📖 Dumping the autoloaded files and reloading all new files.. ');
        $composer = $this->findComposer();
        $appVersion = explode('.', app()::VERSION);

        $process = new Process($appVersion[0] > 6  ? [$composer . ' dump-autoload'] : $composer . ' dump-autoload');
        $process->setTimeout(null);
        $process->setWorkingDirectory(base_path())->run();

        $this->info('Laravel Docsify successfully installed!');
        $this->info('Visit ' . config('docsify.docs.route') . ' in your browser 🚀');
    }

    /**
     * Get the composer command for the environment.
     *
     * @return string
     */
    protected function findComposer()
    {
        if (file_exists(getcwd() . '/composer.phar')) {
            return '"' . PHP_BINARY . '" ' . getcwd() . '/composer.phar';
        }

        return 'composer';
    }
}
