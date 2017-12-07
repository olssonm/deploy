<?php namespace Olssonm\Deploy\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\Scheduling\Schedule;
use Olssonm\Deploy\Deploy;

class DeployWhenCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deploy:when';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check when the application was last deployed';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Schedule $schedule)
    {
        parent::__construct();
    }

    public function handle(Deploy $deploy)
    {
        return $this->info('Last deploy occurred @ ' . $deploy->when());
    }
}
