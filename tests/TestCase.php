<?php

namespace Bpocallaghan\A2H\Tests;

use Illuminate\Support\Facades\File;
use Bpocallaghan\A2H\A2HServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();

        $this->cleanOutputDirectory();
    }

    private function cleanOutputDirectory(): void
    {
        if (File::isDirectory('output')) {
            File::deleteDirectories('output');
        }

        //if (File::isDirectory('resources')) {
        //    File::deleteDirectories('resources');
        //}

        if (File::isDirectory('app')) {
            File::deleteDirectories('app');
        }

        if (File::isDirectory('database')) {
            File::deleteDirectories('database');
        }
    }

    /**
     * Load package service provider.
     *
     * @param \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageProviders($app): array
    {
        return [
            A2HServiceProvider::class
        ];
    }
}
