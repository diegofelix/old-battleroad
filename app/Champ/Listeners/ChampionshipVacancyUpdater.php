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
     * Handle the event.
     *
     * @param UserJoined $event
     */
    public function handle(UserJoined $event)
    {
        $championship = $event->join->championship;

        // update only if championship has a limit
        if (0 != $championship->limit) {
            $championship->limit--;
            $this->repository->save($championship);
        }
    }
}
