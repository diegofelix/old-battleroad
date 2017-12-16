<?php

namespace Champ\Listeners;

use Champ\Championship\Repository;
use Laracasts\Commander\Events\EventListener;
use Champ\Join\Events\UserJoined;
use Champ\Join\Events\JoinCancelled;

class CompetitionVacancyUpdater extends EventListener
{
    /**
     * @var Repository
     */
    protected $championships;

    /**
     * Class constructor.
     *
     * @param Repository $competitionRepository
     */
    public function __construct(Repository $competitionRepository)
    {
        $this->championships = $competitionRepository;
    }

    /**
     * Handle the event.
     *
     * @param UserJoined $event
     */
    public function handle(UserJoined $event)
    {
        $this->addVacancy($event, -1);
    }

    /**
     * Add the vacancy back when user cancel the championship.
     *
     * @param JoinCancelled $event
     */
    public function whenJoinCancelled(JoinCancelled $event)
    {
        $this->addVacancy($event);
    }

    /**
     * Add or remove vacancy for the competition.
     *
     * @param $event
     * @param int $value
     */
    private function addVacancy($event, $value = 1)
    {
        $items = $event->join->items;

        if ($items->count()) {
            foreach ($items as $item) {
                $competition = $item->competition;
                $competition->limit += $value;
                $this->championships->saveCompetition($competition);
            }
        }
    }
}
