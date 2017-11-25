<?php

namespace Champ\Join;

use Champ\Services\JoinUserService;
use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;

class JoinCommandHandler implements CommandHandler
{
    use DispatchableTrait;

    /**
     * Join User Service.
     *
     * @var JoinUserService
     */
    protected $joinUserService;

    public function __construct(JoinUserService $joinUserService)
    {
        $this->joinUserService = $joinUserService;
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
