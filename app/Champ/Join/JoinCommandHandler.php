<?php namespace Champ\Join;

use App;
use Champ\Championship\Repositories\CompetitionRepositoryInterface;
use Champ\Join\Join;
use Champ\Join\Repositories\ItemRepositoryInterface;
use Champ\Join\Repositories\JoinRepositoryInterface;
use Champ\Services\JoinUserService;
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

    /**
     * Join User Service
     * @var [type]
     */
    protected $userJoinService;

    use DispatchableTrait;

    public function __construct(
        JoinUserService $joinUserService
        // JoinRepositoryInterface $joinRepo,
        // CompetitionRepositoryInterface $competitionRepo,
        // ItemRepositoryInterface $itemRepo
    )
    {
        $this->joinUserService = $joinUserService;
        // $this->JoinRepo         = $joinRepo;
        // $this->competitionRepo  = $competitionRepo;
        // $this->itemRepo         = $itemRepo;
    }

    public function handle($command)
    {
        $join = $this->joinUserService->register(
            $command->user,
            $command->championship,
            $command->competitions,
            $command->nicks,
            $command->team_name
        );

        // $join = Join::register(
        //     $command->user->id,
        //     $command->championship->id,
        //     $command->nicks,
        //     $command->competitions
        // );



        // $this->JoinRepo->save($join);

        // $this->dispatchEventsFor($join);

        return $join;
    }
}
