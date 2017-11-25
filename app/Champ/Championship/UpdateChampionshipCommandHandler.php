<?php

namespace Champ\Championship;

use Laracasts\Commander\CommandHandler;
use Champ\Championship\Repository;

class UpdateChampionshipCommandHandler implements CommandHandler
{
    /**
     * @var Repository
     */
    protected $repository;

    /**
     * Class constructor.
     *
     * @param Repository $repository
     */
    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function handle($command)
    {
        $championship = $this->repository->find($command->id);

        $championship->updateInformation($command->name, $command->description, $command->stream);

        $this->repository->save($championship);

        // get the events if needed
        // $this->dispatchEventsFor($championship);

        return $championship;
    }
}
