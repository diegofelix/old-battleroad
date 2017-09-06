<?php
namespace Battleroad\Console\Commands;

use Indatus\Dispatcher\Scheduling\ScheduledCommand;
use Indatus\Dispatcher\Scheduling\Schedulable;
use Indatus\Dispatcher\Drivers\Cron\Scheduler;
use Champ\Championship\Repositories\ChampionshipRepositoryInterface;

class FinishChampionshipCommand extends ScheduledCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'champ:finish-championship';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cancel past championships';

    /**
     * Join Repository.
     *
     * @var ChampionshipRepositoryInterface
     */
    protected $championshipRepository;

    /**
     * Create a new command instance.
     */
    public function __construct(ChampionshipRepositoryInterface $championshipRepository)
    {
        $this->championshipRepository = $championshipRepository;
        parent::__construct();
    }

    /**
     * When a command should run.
     *
     * @param Scheduler $scheduler
     *
     * @return \Indatus\Dispatcher\Scheduling\Schedulable
     */
    public function schedule(Schedulable $scheduler)
    {
        return $scheduler->daily()->hours(1)->minutes(0);
        // return $scheduler->everyMinutes(1);
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->championshipRepository->finishPastChampionships();
    }
}
