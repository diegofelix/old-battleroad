<?php namespace Champ\Listeners;

use Laracasts\Commander\Events\EventListener;
use Champ\Join\Events\UserJoined;
use Champ\Championship\Repositories\CompetitionRepositoryInterface;

class CompetitionVacancyUpdater extends EventListener {

    protected $competitionRepository;

    public function __construct(CompetitionRepositoryInterface $competitionRepository)
    {
        $this->competitionRepository = $competitionRepository;
    }

    /**
     * Update the championship limit when a user join the championship
     *
     * @param  UserJoined $event
     * @return void
     */
    public function whenUserJoined(UserJoined $event)
    {
        $items = $event->join->items;
        if ($items->count())
        {
            foreach ($items as $item)
            {
                $competition = $item->competition;
                $competition->limit--;
                $this->competitionRepository->save($competition);
            }
        }

    }

}