<?php namespace Olssonm\Deploy\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\Scheduling\Schedule;
use Olssonm\Deploy\Deploy;
use Carbon\Carbon;

/**
 *
 */
class DeployMakeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deploy:make';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mark the application as deployed';

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
        $deploy->make();

        return $this->info('Deployed @ ' . Carbon::now()->format('Y-m-d H:i:s') . PHP_EOL);
    }
}
