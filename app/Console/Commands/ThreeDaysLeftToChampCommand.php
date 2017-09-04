<?php
namespace Battleroad\Console\Commands;

use Indatus\Dispatcher\Scheduling\ScheduledCommand;
use Indatus\Dispatcher\Scheduling\Schedulable;
use Indatus\Dispatcher\Drivers\Cron\Scheduler;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Champ\Championship\Repositories\ChampionshipRepositoryInterface;

class ThreeDaysLeftToChampCommand extends ScheduledCommand {

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
		return $scheduler->daily()->hours(6)->minutes(0);
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{
		$joins = $this->championshipRepository->getUsersFromCommingChampionships();

		foreach ($joins as $join)
		{
			$parameters = [
	            'name' => $join->user->name,
	            'join' => $join
	        ];

			Mail::send('emails.send_alert', $parameters, function($message) use ($join)
            {
                $message->to($join->user->email)->subject("Último dia para pagar sua inscrição pro campeonato!");
            });
		}
	}

}
