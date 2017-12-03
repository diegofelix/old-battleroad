<?php

namespace Champ\Championship\Registration;

use Champ\Championship\Repository;
use Laracasts\Commander\CommandHandler;
use Champ\Championship\Championship;
use App;

class RegisterChampionshipCommandHandler implements CommandHandler
{
    /**
     * Championship Repository.
     */
    protected $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function handle($command)
    {
        // do the upload
        $image = $this->uploadImage($command->image);

        $championship = Championship::register(
            $command->user_id,
            $command->name,
            $command->description,
            $command->location,
            $command->event_start,
            $image->getImagePath(),
            $image->getThumbPath()
        );

        $this->repository->save($championship);

        //$this->dispatchEventsFor($championship);

        return $championship;
    }

    /**
     * Upload an image.
     *
     * @param array $data
     *
     * @return string url to the image uploaded
     */
    private function uploadImage($image)
    {
        $champImage = App::make('Champ\Services\ChampionshipImage');

        return $champImage->upload($image);
    }
}
