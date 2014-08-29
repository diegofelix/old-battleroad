<?php

use Champ\Join\Join;
use Champ\Join\Repositories\JoinRepositoryInterface;
use Champ\Join\UpdateJoinCommand;
use Laracasts\Commander\CommanderTrait;

class NotificationController extends BaseController {

    use CommanderTrait;

    /**
     * Join repository
     *
     * @var JoinRepositoryInterface
     */
    protected $joinRepository;

    public function __construct(JoinRepositoryInterface $joinRepository)
    {
        $this->joinRepository = $joinRepository;
    }

    /**
     * Receives the notification and handle it
     *
     * @return Response
     */
    public function nasp()
    {
        $join = $this->execute(UpdateJoinCommand::class);

        Log::info('Join updated');
    }
}
