<?php

namespace Champ\Listeners;

use Laracasts\Commander\Events\EventListener;
use Champ\Join\Events\UserJoined;
use Champ\Championship\Repositories\ChampionshipRepository;

class ChampionshipVacancyUpdater extends EventListener
{
    protected $championshipRepository;

    public function __construct(ChampionshipRepository $championshipRepository)
    {
        $this->championshipRepository = $championshipRepository;
    }

    /**
     * Update the championship limit when a user join the championship.
     *
     * @param UserJoined $event
     */
    public function whenUserJoined(UserJoined $event)
    {
        $championship = $event->join->championship;

        // update only if championship has a limit
        if (0 != $championship->limit) {
            $championship->limit--;
            $this->championshipRepository->save($championship);
        }
    }
}
