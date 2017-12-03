<?php

namespace Champ\Championship;

use Laracasts\Commander\CommandHandler;

class UpdateChampionshipCommandHandler implements CommandHandler
{
    /**
     * Championship Repository.
     *
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

    /**
     * {@inheritdoc}
     */
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
