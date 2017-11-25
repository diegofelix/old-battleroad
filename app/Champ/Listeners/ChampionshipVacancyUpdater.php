<?php

namespace Champ\Listeners;

use Laracasts\Commander\Events\EventListener;
use Champ\Join\Events\UserJoined;
use Champ\Championship\Repository;

class ChampionshipVacancyUpdater extends EventListener
{
    /**
     * Championship Repository.
     *
     * @var Repository
     */
    protected $repository;

    /**
     * Class constructor.
     *
     * @param Repository $repository
     */
    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
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
            $this->repository->save($championship);
        }
    }
}
