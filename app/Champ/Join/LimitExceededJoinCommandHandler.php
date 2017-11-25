<?php

namespace Champ\Join;

use Champ\Account\User;
use Champ\Championship\Repository;
use Champ\Join\Repositories\WaitingListRepository;
use Champ\Services\RegisterUser;
use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;

class LimitExceededJoinCommandHandler implements CommandHandler
{
    use DispatchableTrait;

    /**
     * Championship Repository.
     *
     * @var Repository
     */
    protected $repository;

    /**
     * Waiting List Repository.
     *
     * @var WaitingListRepository
     */
    protected $waitingList;

    /**
     * Register User Service.
     *
     * @var RegisterUser
     */
    private $userService;

    /**
     * Constructor.
     *
     * @param Repository            $repository
     * @param WaitingListRepository $waitingList
     * @param RegisterUser          $userService
     */
    public function __construct(
        Repository $repository,
        WaitingListRepository $waitingList,
        RegisterUser $userService
    ) {
        $this->repository = $repository;
        $this->waitingList = $waitingList;
        $this->userService = $userService;
    }

    public function handle($command)
    {
        $user = $this->userService->getOrCreateUser($command);
        $championship = $this->repository->find($command->championship_id);
        $waitingList = WaitingList::register($user->id, $championship->id, $command->competitions[0]);

        $this->waitingList->save($waitingList);

        $this->dispatchEventsFor($user);

        return $waitingList;
    }
}
