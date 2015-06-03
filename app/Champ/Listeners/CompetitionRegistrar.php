<?php namespace Champ\Listeners;

use Champ\Championship\Repositories\CompetitionRepositoryInterface;
use Champ\Join\Events\UserJoined;
use Laracasts\Commander\Events\EventListener;

class CompetitionRegistrar extends EventListener {

    /**
     * Competition Repository
     *
     * @var CompetitionRepository
     */
    protected $competitionRepository;

    public function __construct(CompetitionRepositoryInterface $competitionRepository)
    {
        $this->competitionRepository = $competitionRepository;
    }

    public function whenUserJoined(UserJoined $event)
    {
        $competitions = $this->competitionRepo->getByIds($event->competitions);

        foreach ($competitions as $competition)
        {
            if ($competition->limit > 0)
            {
                $this->addItemToJoin($event->join, $competition);
            }
        }
    }

    /**
     * Add a competition ( item ) to a Join
     *
     * @param Join $join
     * @param Competition $competition
     */
    private function addItemToJoin($join, $competition)
    {
        $item = $join->addItem($competition->id, $competition->price);
        $this->itemRepo->save($item);
    }
}
