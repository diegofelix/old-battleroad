<?php

namespace Champ\Join;

use Champ\Championship\Repositories\CompetitionRepository;
use Champ\Join\Repositories\ItemRepository;
use Champ\Join\Repositories\JoinRepository;
use Champ\Services\JoinUserService;
use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;

class JoinCommandHandler implements CommandHandler
{
    /**
     * Join Repository.
     */
    protected $joinRepo;

    /**
     * Competition Repository.
     */
    protected $competitionRepo;

    /**
     * Competition Repository.
     */
    protected $itemRepo;

    /**
     * Join User Service.
     *
     * @var [type]
     */
    protected $userJoinService;

    use DispatchableTrait;

    public function __construct(
        JoinUserService $joinUserService
        // JoinRepository $joinRepo,
        // CompetitionRepository $competitionRepo,
        // ItemRepository $itemRepo
    ) {
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

        $this->dispatchEventsFor($join);

        return $join;
    }
}
