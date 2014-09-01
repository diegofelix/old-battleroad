<?php namespace Champ\Join;

use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;
use Champ\Join\Join;
use Champ\Join\Repositories\JoinRepositoryInterface;
use Champ\Join\Repositories\ItemRepositoryInterface;
use Champ\Championship\Repositories\CompetitionRepositoryInterface;
use App;

class JoinCommandHandler implements CommandHandler {

    /**
     * Join Repository
     */
    protected $joinRepo;

    /**
     * Competition Repository
     */
    protected $competitionRepo;

    /**
     * Competition Repository
     */
    protected $itemRepo;

    use DispatchableTrait;

    public function __construct(
        JoinRepositoryInterface $joinRepo,
        CompetitionRepositoryInterface $competitionRepo,
        ItemRepositoryInterface $itemRepo
    )
    {
        $this->JoinRepo = $joinRepo;
        $this->competitionRepo  = $competitionRepo;
        $this->itemRepo         = $itemRepo;
    }

    public function handle($command)
    {
        // register a Join
        $join = $this->registerJoin($command);

        // add the competitions
        $this->registerCompetitions($join, $command);

        $this->dispatchEventsFor($join);

        return $join;
    }

    /**
     * Register a Join
     *
     * @param  Command $command
     * @return Join
     */
    private function registerJoin($command)
    {
        $join = Join::register(
            $command->user->id,
            $command->championship->id,
            $command->championship->price
        );

        $this->JoinRepo->save($join);

        return $join;
    }

    /**
     * Pass through all competitions and create a Join item
     *
     * @param  Join $join
     * @param  Command $command
     * @return void
     */
    private function registerCompetitions($join, $command)
    {
        if ( ! $command->competitions) return false;

        $competitions = $this->competitionRepo->getByIds($command->competitions);

        foreach ($competitions as $competition)
        {
            if ($competition->limit > 0)
            {
                $this->addItemToJoin($join, $competition);
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