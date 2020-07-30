<?php

namespace Bpocallaghan\A2H\Commands;

use Bpocallaghan\A2H\Traits\CopyFilesHelpers;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\File;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class InstallCommand extends GeneratorCommand
{
    use CopyFilesHelpers;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'a2h:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Copy the manifest.json, favicon and serviceworker.js files.';

    /**
     * The filesystem instance.
     *
     * @var Filesystem
     */
    protected $filesystem;

    private $appPath;

    private $basePath;

    // directory separator
    private $ds;

    /**
     * Execute the command
     */
    public function handle()
    {
        // save local vars
        $this->filesystem = $this->files;
        $this->ds = DIRECTORY_SEPARATOR;
        $this->basePath = __DIR__ . $this->ds . '..' . $this->ds . '..' . $this->ds;
        $this->appPath = $this->basePath . "app" . $this->ds;

        $this->copyFavicons();

        //$this->copyFiles();
    }

    /**
     * Copy the favicons directory
     */
    private function copyFavicons()
    {
        $source = "{$this->basePath}resources{$this->ds}images{$this->ds}favicons";
        $destination = "public{$this->ds}images{$this->ds}favicons";
        $this->copyFilesFromSource($source, $destination);
    }

    /**
     * Copy the config file to the default config folder
     */
    private function copyConfigFile()
    {
        $path = $this->getConfigPath();

        // if generatords config already exist
        if ($this->files->exists($path) && $this->option('force') === false) {
            $this->error("{$path} already exists! Run 'generate:publish-stubs --force' to override the config file.");
            die;
        }

        File::copy(__DIR__ . '/../config/config.php', $path);
    }



    /**
     * Update stubs path in the new published config file
     */
    private function updateStubsPathsInConfigFile()
    {
        $updated = str_replace('vendor/bpocallaghan/generators/', '',
            File::get($this->getConfigPath()));
        File::put($this->getConfigPath(), $updated);
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [];
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        //
    }
}