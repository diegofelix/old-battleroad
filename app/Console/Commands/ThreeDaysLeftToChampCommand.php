<?php

namespace Battleroad\Console\Commands;

use Champ\Championship\Repository;
use Indatus\Dispatcher\Scheduling\ScheduledCommand;
use Indatus\Dispatcher\Scheduling\Schedulable;
use Indatus\Dispatcher\Drivers\Cron\Scheduler;

class ThreeDaysLeftToChampCommand extends ScheduledCommand
{
    /**
     * Championship Repository.
     *
     * @var Repository
     */
    protected $repository;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'champ:three-days-left-alert';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Alert the users that the championship is comming';

    /**
     * Class constructor.
     *
     * @param Repository $repository
     */
    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
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
        return $scheduler->daily()->hours(6)->minutes(0);
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $joins = $this->repository->getUsersFromCommingChampionships();

        foreach ($joins as $join) {
            $parameters = [
                'name' => $join->user->name,
                'join' => $join,
            ];

            Mail::send('emails.send_alert', $parameters, function ($message) use ($join) {
                $message->to($join->user->email)->subject('Último dia para pagar sua inscrição pro campeonato!');
            });
        }
    }
}
