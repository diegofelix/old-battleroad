<?php

namespace Champ\Championship\Jobs;

use Battleroad\Jobs\Job;
use Champ\Championship\Repository;
use Champ\Championship\ImageUploader;
use Illuminate\Queue\SerializesModels;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UpdateBanner extends Job
{
    use SerializesModels;

    /**
     * @var int
     */
    protected $id;

    /**
     * @var Repository
     */
    protected $repository;

    /**
     * @var string
     */
    protected $image;

    /**
     * Class constructor.
     *
     * @param int          $id
     * @param UploadedFile $image
     */
    public function __construct($id, UploadedFile $image)
    {
        $this->id = $id;
        $this->image = $image;
        $this->repository = app(Repository::class);
    }

    /**
     * Execute the job.
     *
     * @param ImageUploader $uploader
     *
     * @return \Champ\Championship\Championship
     */
    public function handle(ImageUploader $uploader)
    {
        $image = $uploader->upload($this->image);

        $championship = $this->updateBanner($image);

        $this->repository->save($championship);

        return $championship;
    }

    /**
     * Update championship with the new banner image.
     *
     * @param ImageUploader $image
     *
     * @return \Champ\Championship\Championship
     */
    private function updateBanner(ImageUploader $image)
    {
        $championship = $this->repository->find($this->id);

        $championship->updateBanner($image->getImagePath());

        return $championship;
    }
}
