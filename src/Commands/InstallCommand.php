<?php

namespace Bpocallaghan\A2H\Commands;

use Illuminate\Support\Facades\File;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class InstallCommand extends GeneratorCommand
{
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
     * Execute the command
     */
    public function handle()
    {
        $this->copyFiles();
    }

    /**
     * Copy files
     */
    private function copyFiles()
    {
        // copy manigest.json to /public
        // copy the favicons to /public/images/favicons
        // copy the serviceworker.js to /public
        // update master layout
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
     * Copy the stubs directory
     */
    private function copyStubsDirectory()
    {
        $path = $this->option('path');

        // if controller stub already exist
        if ($this->files->exists($path . DIRECTORY_SEPARATOR . 'controller.stub') && $this->option('force') === false) {
            $this->error("Stubs already exists! Run 'generate:publish-stubs --force' to override the stubs.");
            die;
        }

        File::copyDirectory(__DIR__ . '/../../resources/stubs', $path);
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
        return [
            ['force', null, InputOption::VALUE_NONE, 'Warning: Override files if it already exist']
        ];
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