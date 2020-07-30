<?php

namespace Bpocallaghan\A2H\Tests;

class InstallCommandTest extends TestCase
{
    /** @test */
    public function install_command()
    {
        $this->artisan('a2h:install');

        $this->assertFileExists('public/manifest.json');
        $this->assertFileExists('public/serviceworker.js');
        $this->assertFileExists('public/images/favicons/16x16.png');
        $this->assertFileExists('public/images/favicons/32x32.png');
        $this->assertFileExists('public/images/favicons/192x192.png');
        $this->assertFileExists('public/images/favicons/512x512.png');
        $this->assertFileExists('public/images/favicons/favicon.ico');
    }

    /** @test */
    public function confirm_override_when_files_exists()
    {
        $this->artisan('a2h:install');
        $this->artisan('a2h:install')
            // root files
            ->expectsQuestion("Above is a list of the files that already exist. Override all files?",
                true)
            // favicons
            ->expectsQuestion("Above is a list of the files that already exist. Override all files?",
                true);

        $this->assertFileExists('public/manifest.json');
        $this->assertFileExists('public/images/favicons/favicon.ico');
    }
}