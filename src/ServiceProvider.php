<?php namespace Olssonm\Deploy;

use Olssonm\Deploy\Console\Commands\DeployMakeCommand;
use Olssonm\Deploy\Console\Commands\DeployWhenCommand;
use Olssonm\Deploy\Deploy;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(\Illuminate\Routing\Router $router)
    {
        $this->app->bind('command.deploy:mark', DeployMakeCommand::class);
        $this->app->bind('command.deploy:when', DeployWhenCommand::class);

        $this->commands([
            'command.deploy:mark',
            'command.deploy:when'
        ]);
    }

    public function register()
    {
        $this->app->singleton('deploy', function () {
            return new Deploy();
        });

        $this->app->alias('deploy', Deploy::class);
    }

    public function provides()
    {
        return [
            'deploy'
        ];
    }
}
