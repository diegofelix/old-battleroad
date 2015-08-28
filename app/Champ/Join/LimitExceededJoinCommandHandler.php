<?php

namespace Champ\Join;

use App;
use Champ\Account\Profile;
use Champ\Account\Repositories\UserRepositoryInterface;
use Champ\Account\User;
use Champ\Championship\Repositories\ChampionshipRepositoryInterface;
use Champ\Join\Repositories\JoinRepositoryInterface;
use Champ\Join\Repositories\WaitingListRepositoryInterface;
use Champ\Services\JoinUserService;
use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;

class LimitExceededJoinCommandHandler implements CommandHandler {

    /**
     * User Repository
     *
     * @var  Champ\Account\Repositories\UserRepositoryInterface
     */
    protected $userRepository;

    /**
     * Championship Repository
     *
     * @var Champ\Championship\Repositories\ChampionshipRepositoryInterface
     */
    protected $championshipRepository;

    /**
     * Waiting List Repository
     *
     * @var Champ\Join\Repositories\WaitingListRepositoryInterface
     */
    protected $waitingList;

    use DispatchableTrait;

    /**
     * Constructor
     *
     * @param ChampionshipRepositoryInterface $championshipRepository
     * @param UserRepositoryInterface         $userRepository
     */
    public function __construct(
        ChampionshipRepositoryInterface $championshipRepository,
        UserRepositoryInterface $userRepository,
        WaitingListRepositoryInterface $waitingList
    ) {
        $this->championshipRepository = $championshipRepository;
        $this->userRepository = $userRepository;
        $this->waitingList = $waitingList;
    }

    public function handle($command)
    {
        $user         = $this->getOrCreateUser($command);
        $championship = $this->championshipRepository->find($command->championship_id);
        $waitingList  = WaitingList::register($user->id, $championship->id, $command->competitions[0]);

        $this->waitingList->save($waitingList);

        return $waitingList;
    }

    /**
     * Find or creates a new User
     *
     * @param  EmbededJoinCommand $command
     * @return User
     */
    private function getOrCreateUser($command)
    {
        $user = $this->userRepository->getByEmail($command->email);

        if ( ! $user) {
            $user = $this->registerUser($command);
        }

        $this->saveIdentificationToUser($user, $command->identification);

        return $user;
    }

    /**
     * Register a new User
     *
     * @param  EmbededJoinCommand $command
     * @return User
     */
    private function registerUser($command)
    {
        $model = App::make(User::class);

        // first nick he encounter
        $nick  = reset($command->nicks)[0];

        if (! $nick) $nick = $command->name;

        $user = $model->register([
            'name' => $command->name,
            'username' => $nick,
            'email' => $command->email,
            'profile' => 'images/defaultUser.jpg',
        ]);

        $this->userRepository->save($user);

        $this->dispatchEventsFor($user);

        return $user;
    }

    public function saveIdentificationToUser($user, $identification)
    {
        $user->identification = $identification;
        $user->save();
    }
}