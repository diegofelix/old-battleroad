<?php

namespace Champ\Championship\Registration;

use Champ\Championship\ImageUploader;
use Champ\Championship\Repository;
use Laracasts\Commander\CommandHandler;
use Champ\Championship\Championship;
use App;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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
            $image->getImagePath()
        );

        $this->repository->save($championship);

        return $championship;
    }

    /**
     * Upload a championship banner.
     *
     * @param UploadedFile $image
     *
     * @return ImageUploader
     */
    private function uploadImage(UploadedFile $image)
    {
        $imageUploader = app(ImageUploader::class);

        return $imageUploader->upload($image);
    }
}
