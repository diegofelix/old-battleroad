<?php namespace Champ\Listeners;

use Laracasts\Commander\Events\EventListener;
use Champ\Join\Repositories\JoinRepositoryInterface;
use Champ\Championship\Events\ChampionshipPublished;
use Champ\Championship\Events\ChampionshipFinished;
use Config;
use Mail;

class AdminNotificationListener extends EventListener {

    /**
     * Join Repository
     *
     * @var JoinRepositoryInterface
     */
    protected $joinRepository;

    /**
     * Constructor
     *
     * @param JoinRepositoryInterface $joinRepository
     */
    public function __construct(JoinRepositoryInterface $joinRepository)
    {
        $this->joinRepository = $joinRepository;
    }

    /**
     * Notify the admin when a championship is Finished
     *
     * @param  ChampionshipFinished $championship
     * @return void
     */
    public function whenChampionshipFinished(ChampionshipFinished $championship)
    {
        $joins = $this->joinRepository->getByChampionship($championship->championship->id);

        $cancelledJoins = $this->getCancelledJoins($joins);

        Mail::send('emails.join_finished', compact('cancelledJoins'), function($message)
        {
            $message->to(Config::get('champ.admin_email'))->subject("Inscrições canceladas.");
        });
    }

    /**
     * Send a notification to admin when a Championship is Published
     *
     * @param  ChampionshipPublished $championship
     * @return void
     */
    public function whenChampionshipPublished(ChampionshipPublished $championship)
    {
        $championship = $championship->championship;
        Mail::send('emails.championship_published', compact('championship'), function($message)
        {
            $message->to(Config::get('champ.admin_email'))->subject("Novo Campeonato Publicado");
        });
    }

    /**
     * Get all cancelled joins and send to the admin
     *
     * @param  Collection $joins
     * @return array
     */
    private function getCancelledJoins($joins)
    {
        $cancelledJoins = [];

        foreach ($joins as $join)
        {
            if ( ! $join->wasPaid())
            {
                $cancelledJoins[] = $join->id;
                $join->cancelJoin();
            }
        }

        return $cancelledJoins;
    }

}
