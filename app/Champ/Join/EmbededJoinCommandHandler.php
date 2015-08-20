<?php

namespace Champ\Join;

use Champ\Account\Repositories\UserRepositoryInterface;
use Champ\Join\Repositories\JoinRepositoryInterface;

class EmbededJoinCommandHandler implements CommandHandler {

    /**
     * Join Repository
     */
    protected $joinRepository;

    /**
     * User Repository
     */
    protected $userRepository;

    use DispatchableTrait;

    public function __construct(
        JoinRepositoryInterface $joinRepository,
        UserRepositoryInterface $userRepository
    ) {
        $this->joinRepository = $joinRepository;
        $this->userRepository = $userRepository;
    }

    public function handle($command)
    {
        $user = $this->getOrCreateUser($command);
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
            User::register([
                'name' => $command->name,
                'username' => $command->username,
                'email' => $command->email
            ]);
        }
    }
}