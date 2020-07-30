<?php

namespace Bpocallaghan\A2H;

use Bpocallaghan\A2H\Commands\InstallCommand;
use Illuminate\Support\ServiceProvider;

class A2HServiceProvider extends ServiceProvider
{
    private $commandPath = 'command.bpocallaghan.';

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerCommand(InstallCommand::class, 'install');
    }

    /**
     * Register a singleton command
     *
     * @param $class
     * @param $command
     */
    private function registerCommand($class, $command)
    {
        $this->app->singleton($this->commandPath . $command, function ($app) use ($class) {
            return $app[$class];
        });

        $this->commands($this->commandPath . $command);
    }
}