<?php namespace Champ\Join;

use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;
use Champ\Join\Repositories\JoinRepositoryInterface;
use Champ\Billing\Pagseguro\NotificationHandler;

class UpdateJoinCommandHandler implements CommandHandler {

    /**
     * Join Repository
     */
    protected $joinRepository;

    /**
     * Notification Handler
     */
    protected $NotificationHandler;

    use DispatchableTrait;

    public function __construct(
        JoinRepositoryInterface $joinRepository,
        NotificationHandler $notificationHandler
    )
    {
        $this->joinRepository = $joinRepository;
        $this->notificationHandler = $notificationHandler;
    }

    public function handle($command)
    {
        // get the notification data
        $purshase = $this->notificationHandler->handle($command);

        $details = $purshase->getDetails();

        // find the join by the code
        $join = $this->joinRepository->findByToken($details->getCode());

        // update the status
        $join->status = $details->getStatus();

        // save it
        $this->joinRepository->save($join);

        $this->dispatchEventsFor($join);

        return $join;
    }
}