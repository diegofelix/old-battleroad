<?php
namespace Battleroad\Champ\Join\Jobs;

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

    public function __construct(User $user, Championship $championship, $nicks, $competitions, $team_name = null)
    {
        $this->user = $user;
        $this->championship = $championship;
        $this->nicks = $nicks;
        $this->competitions = $competitions;
        $this->team_name = $team_name;
    }


    public function handle(JoinUserService $joinService)
    {
        $join = $joinService->register(
            $this->user,
            $this->championship,
            $this->competitions,
            $this->nicks,
            $this->team_name
        );

        $this->dispatchEventsFor($join);

        return $join;
    }
}
