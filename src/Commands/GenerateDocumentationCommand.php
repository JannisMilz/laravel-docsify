<?php

namespace JannisMilz\Docsify\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class GenerateDocumentationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'docsify:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate docs structure according to your configuration.';

    /**
     * The Filesystem instance.
     *
     * @var Filesystem
     */
    protected $filesystem;

    /**
     * Create a new command instance.
     *
     * @param Filesystem $filesystem
     */
    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;

        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $publishedVersions = config('docsify.versions.published');

        $this->info('Reading all configs and docs versions, found versions: ' . implode(',', $publishedVersions));
        foreach ($publishedVersions as $version) {
            $versionDirectory = config('docsify.docs.path') . '/' . $version;

            $this->line('');
            $this->info('---------------- Version ' . $version . ' ----------------');
            // check if the version directory not exists => create one
            if ($this->createVersionDirectory(base_path($versionDirectory))) {
                $this->line('Docs folder created for v' . $version . ' under ' . $versionDirectory);
            } else {
                $this->line('Docs folder for <info>v' . $version . '</info> already exists.');
            }

            // check if the version sidebar.md not exists => create one
            if ($this->createVersionSidebar(base_path($versionDirectory))) {
                $this->line('sidebar.md created under ' . $versionDirectory);
            } else {
                $this->line('<info>sidebar.md</info> for <info>v' . $version . '</info> already exists.');
            }

            // check if the version landing page not exists => create one
            if ($this->createVersionIndex(base_path($versionDirectory))) {
                $this->line('index.md created under ' . $versionDirectory);
            } else {
                $this->line('<info>index.md</info> for <info>v' . $version . '</info> already exists.');
            }

            $this->info('--------------- /Version ' . $version . ' ----------------');
            $this->line('');
        }
        $this->info('Done.');
    }

    /**
     * Create a new directory for the given version if not exists.
     *
     * @return bool
     */
    protected function createVersionDirectory($versionDirectory)
    {
        if (!$this->filesystem->isDirectory($versionDirectory)) {
            $this->filesystem->makeDirectory($versionDirectory, 0755, true);

            return true;
        }

        return false;
    }

    /**
     * Create sidebar.md for the given version if it's not exists.
     *
     * @param $versionDirectory
     * @return bool
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function createVersionSidebar($versionDirectory)
    {
        $indexPath = $versionDirectory . '/sidebar.md';

        if (!$this->filesystem->exists($indexPath)) {
            $this->filesystem->put($indexPath, $this->getStub('sidebar'));

            return true;
        }

        return false;
    }

    /**
     * Create index.md for the given version if it's not exists.
     *
     * @param $versionDirectory
     * @return bool
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function createVersionIndex($versionDirectory)
    {
        $indexPath = $versionDirectory . '/index.md';

        if (!$this->filesystem->exists($indexPath)) {
            $this->filesystem->put($indexPath, $this->getStub('index'));

            return true;
        }

        return false;
    }

    /**
     * Get the stub file for the generator.
     *
     * @param $stub
     * @return string
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function getStub($stub)
    {
        return $this->filesystem->get(base_path('/vendor/jannismilz/laravel-docsify/stubs/' . $stub . '.stub'));
    }
}
