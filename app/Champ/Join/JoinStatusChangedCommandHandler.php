<?php namespace Champ\Join;

use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;
use Champ\Join\Repositories\JoinRepositoryInterface;

class JoinStatusChangedCommandHandler implements CommandHandler
{
    /**
     * Join Repository.
     */
    protected $joinRepository;

    use DispatchableTrait;

    public function __construct(JoinRepositoryInterface $joinRepository)
    {
        $this->joinRepository = $joinRepository;
    }

    public function handle($command)
    {
        $join = $this->joinRepository->find($command->id);

        $join->changeStatus($command->statusId);

        $this->joinRepository->save($join);

        $this->dispatchEventsFor($join);

        return $join;
    }
}
