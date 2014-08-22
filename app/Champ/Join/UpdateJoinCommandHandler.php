<?php namespace Champ\Join;

use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;
use Champ\Join\Join;
use Champ\Join\Repositories\JoinRepositoryInterface;
use Champ\Join\Repositories\ItemRepositoryInterface;
use Champ\Championship\Repositories\CompetitionRepositoryInterface;
use App;

class UpdateJoinCommandHandler implements CommandHandler {

    /**
     * Join Repository
     */
    protected $joinRepo;

    use DispatchableTrait;

    public function __construct(JoinRepositoryInterface $joinRepo)
    {
        $this->joinRepo = $joinRepo;
    }

    public function handle($command)
    {
        $join = $this->joinRepo->find(str_replace('BRT', '', $command->id));

        $join->status_id        = $command->statusId;
        $join->cancelation_id   = $command->cancelationId;

        $this->joinRepo->save($join);

        $this->dispatchEventsFor($join);

        return $join;
    }
}