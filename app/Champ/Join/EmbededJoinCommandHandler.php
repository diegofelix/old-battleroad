<?php

namespace Champ\Join;

use App;
use Champ\Account\Repositories\UserRepositoryInterface;
use Champ\Account\User;
use Champ\Championship\Repositories\ChampionshipRepositoryInterface;
use Champ\Join\Repositories\JoinRepositoryInterface;
use Champ\Services\JoinUserService;
use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;

class EmbededJoinCommandHandler implements CommandHandler {

    /**
     * Join Repository
     *
     * @var Champ\Join\Repositories\JoinRepositoryInterface
     */
    protected $joinRepository;

    /**
     * User Repository
     *
     * @var  Champ\Account\Repositories\UserRepositoryInterface
     */
    protected $userRepository;

    /**
     * Join User Service
     *
     * @var Champ\Services\JoinUserService
     */
    protected $joinUserService;

    /**
     * Championship Repository
     *
     * @var Champ\Championship\Repositories\ChampionshipRepositoryInterface
     */
    protected $championshipRepository;

    use DispatchableTrait;

    /**
     * Constructor
     *
     * @param JoinRepositoryInterface         $joinRepository
     * @param ChampionshipRepositoryInterface $championshipRepository
     * @param UserRepositoryInterface         $userRepository
     */
    public function __construct(
        JoinRepositoryInterface $joinRepository,
        ChampionshipRepositoryInterface $championshipRepository,
        JoinUserService $joinUserService,
        UserRepositoryInterface $userRepository
    ) {
        $this->joinRepository = $joinRepository;
        $this->championshipRepository = $championshipRepository;
        $this->joinUserService = $joinUserService;
        $this->userRepository = $userRepository;
    }

    public function handle($command)
    {

        $user         = $this->getOrCreateUser($command);
        $championship = $this->championshipRepository->find($command->championship_id);

        $join = $this->joinUserService->register(
            $user,
            $championship,
            $command->competitions,
            $command->nicks
        );

        $this->dispatchEventsFor($join);

        return $join;
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

        $user = $model->register([
            'name' => $command->name,
            'username' => $nick,
            'email' => $command->email,
            'profile' => 'images/defaultUser.jpg'
        ]);

        $this->userRepository->save($user);

        $this->dispatchEventsFor($user);

        return $user;
    }
}