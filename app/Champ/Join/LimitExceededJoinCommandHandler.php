<?php

namespace Champ\Join;

use Champ\Account\Repositories\UserRepository;
use Champ\Account\User;
use Champ\Championship\Repository;
use Champ\Join\Repositories\WaitingListRepository;
use Champ\Services\RegisterUser;
use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;

class LimitExceededJoinCommandHandler implements CommandHandler
{
    /**
     * Championship Repository.
     *
     * @var Repository
     */
    protected $championshipRepository;

    /**
     * Waiting List Repository.
     *
     * @var Champ\Join\Repositories\WaitingListRepository
     */
    protected $waitingList;

    /**
     * Register User Service.
     *
     * @var Champ\Services\RegisterUser
     */
    private $userService;

    use DispatchableTrait;

    /**
     * Constructor.
     *
     * @param Repository            $championshipRepository
     * @param WaitingListRepository $waitingList
     * @param RegisterUser          $userService
     */
    public function __construct(
        Repository $championshipRepository,
        WaitingListRepository $waitingList,
        RegisterUser $userService
    ) {
        $this->championshipRepository = $championshipRepository;
        $this->waitingList = $waitingList;
        $this->userService = $userService;
    }

    public function handle($command)
    {
        $user = $this->userService->getOrCreateUser($command);
        $championship = $this->championshipRepository->find($command->championship_id);
        $waitingList = WaitingList::register($user->id, $championship->id, $command->competitions[0]);

        $this->waitingList->save($waitingList);

        $this->dispatchEventsFor($user);

        return $waitingList;
    }
}
