<?php

use Indatus\Dispatcher\Scheduling\ScheduledCommand;
use Indatus\Dispatcher\Scheduling\Schedulable;
use Indatus\Dispatcher\Drivers\Cron\Scheduler;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Champ\Championship\Repositories\ChampionshipRepositoryInterface;

class FinishChampionshipCommand extends ScheduledCommand {

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
	 * Join Repository
	 *
	 * @var ChampionshipRepositoryInterface
	 */
	protected $championshipRepository;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(ChampionshipRepositoryInterface $championshipRepository)
	{
		$this->championshipRepository = $championshipRepository;
		parent::__construct();
	}

	/**
	 * When a command should run
	 *
	 * @param Scheduler $scheduler
	 * @return \Indatus\Dispatcher\Scheduling\Schedulable
	 */
	public function schedule(Schedulable $scheduler)
	{
		return $scheduler->daily()->hours(1)->minutes(0);
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$this->championshipRepository->finishPastChampionships();
	}
}
