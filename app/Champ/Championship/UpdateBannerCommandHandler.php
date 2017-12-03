<?php

namespace Champ\Championship;

use Laracasts\Commander\CommandHandler;
use Champ\Services\ChampionshipImage;

class UpdateBannerCommandHandler implements CommandHandler
{
    /**
     * Championship Repository.
     *
     * @var Repository
     */
    protected $repository;

    /**
     * Image Uploader.
     *
     * @var ChampionshipImage
     */
    protected $uploader;

    /**
     * Class constructor.
     *
     * @param Repository        $repository
     * @param ChampionshipImage $uploader
     */
    public function __construct(Repository $repository, ChampionshipImage $uploader)
    {
        $this->repository = $repository;
        $this->uploader = $uploader;
    }

    /**
     * {@inheritdoc}
     */
    public function handle($command)
    {
        $image = $this->getUploadedImage($command);

        $championship = $this->updateBanner($command, $image);

        $this->repository->save($championship);

        // get the events if needed
        // $this->dispatchEventsFor($championship);

        return $championship;
    }

    /**
     * Update Championship with the new banner image.
     *
     * @param UpdateBannerCommand $command
     * @param ImageUploader       $image
     *
     * @return Championship
     */
    private function updateBanner($command, $image)
    {
        $championship = $this->repository->find($command->id);

        $championship->updateBanner($image->getImagePath(), $image->getThumbPath());

        return $championship;
    }

    /**
     * Get the uploaded image.
     *
     * @param UpdateBannerCommand $command
     *
     * @return ImageUploader
     */
    private function getUploadedImage($command)
    {
        return $this->uploader->upload($command->image);
    }
}
