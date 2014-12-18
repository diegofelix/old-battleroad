<?php namespace Champ\Championship;

use Laracasts\Commander\CommandHandler;
use Champ\Championship\Repositories\ChampionshipRepositoryInterface;
use App;

class UpdateChampionshipCommandHandler implements CommandHandler {

    /**
     * Championship Repository
     */
    protected $repository;

    public function __construct(ChampionshipRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function handle($command)
    {
        $championship = $this->repository->find($command->id);

        $championship->updateInformation($command->name, $command->description);

        $this->repository->save($championship);

        // get the events if needed
        // $this->dispatchEventsFor($championship);

        return $championship;
    }
}