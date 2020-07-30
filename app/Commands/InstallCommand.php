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

        $this->copyJsFile();
        $this->copyFavicons();
        $this->copyPublicRootFiles();
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
     * Copy the manifest.json and serviceworker.js
     */
    private function copyPublicRootFiles()
    {
        $source = [
            "{$this->basePath}resources{$this->ds}manifest.json",
            "{$this->basePath}resources{$this->ds}serviceworker.js",
        ];
        $destination = "public{$this->ds}";
        $this->copyFilesFromSource($source, $destination);
    }

    /**
     * Copy the manifest.json and serviceworker.js
     */
    private function copyJsFile()
    {
        $source = "{$this->basePath}resources{$this->ds}js{$this->ds}a2h.js";
        $destination = "resources{$this->ds}js{$this->ds}";
        $this->copyFilesFromSource($source, $destination);
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
