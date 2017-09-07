<?php

namespace Champ\Join;

use Champ\Account\User;
use Champ\Championship\Repositories\ChampionshipRepository;
use Champ\Join\Repositories\JoinRepositoryInterface;
use Champ\Services\JoinUserService;
use Champ\Services\RegisterUser;
use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;

class EmbededJoinCommandHandler implements CommandHandler
{
    /**
     * Join Repository.
     *
     * @var Champ\Join\Repositories\JoinRepositoryInterface
     */
    protected $joinRepository;

    /**
     * Register User Service.
     *
     * @var Champ\Services\RegisterUser
     */
    protected $userService;

    /**
     * Join User Service.
     *
     * @var Champ\Services\JoinUserService
     */
    protected $joinUserService;

    /**
     * Championship Repository.
     *
     * @var Champ\Championship\Repositories\ChampionshipRepository
     */
    protected $championshipRepository;

    use DispatchableTrait;

    /**
     * Constructor.
     *
     * @param JoinRepositoryInterface         $joinRepository
     * @param ChampionshipRepository $championshipRepository
     * @param UserRepository         $userRepository
     */
    public function __construct(
        JoinRepositoryInterface $joinRepository,
        ChampionshipRepository $championshipRepository,
        JoinUserService $joinUserService,
        RegisterUser $userService
    ) {
        $this->joinRepository = $joinRepository;
        $this->championshipRepository = $championshipRepository;
        $this->joinUserService = $joinUserService;
        $this->userService = $userService;
    }

    public function handle($command)
    {
        $user = $this->userService->getOrCreateUser($command);
        $championship = $this->championshipRepository->find($command->championship_id);

        $join = $this->joinUserService->register(
            $user,
            $championship,
            $command->competitions,
            $command->nicks
        );

        $this->dispatchEventsFor($user);
        $this->dispatchEventsFor($join);

        return $join;
    }
}
