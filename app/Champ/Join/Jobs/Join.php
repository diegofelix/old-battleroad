<?php

namespace Champ\Join\Jobs;

use Battleroad\Jobs\Job;
use Champ\Account\User;
use Champ\Championship\Championship;
use Champ\Services\JoinUserService;
use Illuminate\Contracts\Bus\SelfHandling;

class Join extends Job implements SelfHandling
{
    /**
     * @var User
     */
    public $user;

    /**
     * @var Championship
     */
    public $championship;

    /**
     * @var array
     */
    public $nicks;

    /**
     * @var array
     */
    public $competitions;

    /**
     * @var string
     */
    public $team_name;

    /**
     * Join constructor.
     *
     * @param User         $user
     * @param Championship $championship
     * @param array        $nicks
     * @param array        $competitions
     * @param string|null  $team_name
     */
    public function __construct(
        User $user,
        Championship $championship,
        $nicks,
        $competitions,
        $team_name = null
    ) {
        $this->user = $user;
        $this->championship = $championship;
        $this->nicks = $nicks;
        $this->competitions = $competitions;
        $this->team_name = $team_name;
    }

    /**
     * Execute the job.
     *
     * @param JoinUserService $joinService
     *
     * @return \Champ\Join\Join
     *
     * @throws \Champ\Join\UserAlreadyJoinedException
     */
    public function handle(JoinUserService $joinService)
    {
        return $joinService->register(
            $this->user,
            $this->championship,
            $this->competitions,
            $this->nicks,
            $this->team_name
        );
    }
}
