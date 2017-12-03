<?php

namespace Champ\Championship\Jobs;

use Battleroad\Jobs\Job;
use Champ\Championship\Repository;
use Champ\Services\ChampionshipImage;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Queue\SerializesModels;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UpdateBanner extends Job implements SelfHandling
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
     * @param ChampionshipImage $uploader
     *
     * @return \Champ\Championship\Championship
     */
    public function handle(ChampionshipImage $uploader)
    {
        $image = $uploader->upload($this->image);

        $championship = $this->updateBanner($image);

        $this->repository->save($championship);

        return $championship;
    }

    /**
     * Update championship with the new banner image.
     *
     * @param ChampionshipImage $image
     *
     * @return \Champ\Championship\Championship
     */
    private function updateBanner(ChampionshipImage $image)
    {
        $championship = $this->repository->find($this->id);

        $championship->updateBanner($image->getImagePath(), $image->getThumbPath());

        return $championship;
    }
}
