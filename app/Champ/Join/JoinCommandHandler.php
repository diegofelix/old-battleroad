<?php namespace Champ\Join;

use App;
use Champ\Championship\Repositories\CompetitionRepositoryInterface;
use Champ\Join\Join;
use Champ\Join\Repositories\ItemRepositoryInterface;
use Champ\Join\Repositories\JoinRepositoryInterface;
use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;

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
        $this->JoinRepo         = $joinRepo;
        $this->competitionRepo  = $competitionRepo;
        $this->itemRepo         = $itemRepo;
    }

    public function handle($command)
    {
        $join = Join::register(
            $command->user->id,
            $command->championship->id,
            $command->nicks,
            $command->competitions
        );

        $this->JoinRepo->save($join);

        $this->dispatchEventsFor($join);

        return $join;
    }
}
