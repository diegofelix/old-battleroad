<?php
namespace Battleroad\Champ\Championship\Jobs;

use Battleroad\Jobs\Job;
use Champ\Championship\Championship;
use Champ\Championship\ImageUploader;
use Champ\Championship\Repository;
use Illuminate\Contracts\Bus\SelfHandling;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class RegisterChampionship extends Job implements SelfHandling
{
    /**
     * @var int
     */
    public $userId;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $description;

    /**
     * @var UploadedFile
     */
    public $image;

    /**
     * @var string
     */
    public $eventStart;

    /**
     * @var string
     */
    public $location;

    /**
     * @var int
     */
    public $limit;

    /**
     * RegisterChampionship constructor.
     *
     * @param string       $userId
     * @param string       $name
     * @param string       $description
     * @param string       $location
     * @param string       $eventStart
     * @param UploadedFile $image
     */
    public function __construct($userId, $name, $description, $location, $eventStart, $image = null)
    {
        $this->userId = $userId;
        $this->name = $name;
        $this->description = $description;
        $this->location = $location;
        $this->eventStart = $eventStart;
        $this->image = $image;
    }

    /**
     * {@inheritdoc}
     */
    public function handle(Repository $repository)
    {
        // do the upload
        $image = $this->uploadImage($this->image);

        $championship = Championship::register(
            $this->userId,
            $this->name,
            $this->description,
            $this->location,
            $this->eventStart,
            $image->getImagePath()
        );

        $repository->save($championship);

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
