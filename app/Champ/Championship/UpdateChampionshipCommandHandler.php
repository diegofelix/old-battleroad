<?php

namespace Champ\Championship;

use Laracasts\Commander\CommandHandler;
use Champ\Championship\Repositories\ChampionshipRepository;

class UpdateChampionshipCommandHandler implements CommandHandler
{
    /**
     * Championship Repository.
     */
    protected $repository;

    public function __construct(ChampionshipRepository $repository)
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
