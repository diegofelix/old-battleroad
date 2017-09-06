<?php namespace Champ\Listeners;

use Laracasts\Commander\Events\EventListener;
use Champ\Join\Events\UserJoined;
use Champ\Join\Events\JoinCancelled;
use Champ\Championship\Repositories\CompetitionRepositoryInterface;

class CompetitionVacancyUpdater extends EventListener
{
    protected $competitionRepository;

    public function __construct(CompetitionRepositoryInterface $competitionRepository)
    {
        $this->competitionRepository = $competitionRepository;
    }

    /**
     * Subtract a vacancy in the competition when user join the championship.
     *
     * @param UserJoined $event
     */
    public function whenUserJoined(UserJoined $event)
    {
        $this->addVancancy($event, -1);
    }

    /**
     * Add the vacancy back when user cancel the championship.
     *
     * @param JoinCancelled $event
     */
    public function whenJoinCancelled(JoinCancelled $event)
    {
        $this->addVancancy($event);
    }

    /**
     * Add or remove vancancy for the competition.
     *
     * @param $event
     * @param int $value
     */
    private function addVancancy($event, $value = 1)
    {
        $items = $event->join->items;
        if ($items->count()) {
            foreach ($items as $item) {
                $competition = $item->competition;
                $competition->limit += $value;
                $this->competitionRepository->save($competition);
            }
        }
    }
}
