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
        $join = $this->joinRepo->find(str_replace('BTR', '', $command->id));

        $join->status_id        = $command->statusId;
        $join->cancelation_id   = $command->cancelationId;

        // if the status was cancelled, then send an e-mail with the reason to the user;
        // the description of the reason is in the cancelation_statuses table
        //
        // in any case, send an e-mail to the user btw

        $this->joinRepo->save($join);

        $this->dispatchEventsFor($join);

        return $join;
    }
}