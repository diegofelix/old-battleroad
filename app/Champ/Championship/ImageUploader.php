<?php

namespace Champ\Championship;

use Intervention\Image\Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageUploader
{
    /**
     * @var Image
     */
    protected $image;

    /**
     * The uploaded image.
     *
     * @var Image
     */
    protected $uploadedImage;

    /**
     * Relative path to the images.
     *
     * @var string
     */
    protected $path = 'images/championships/';

    /**
     * Max width of the image.
     *
     * @var int
     */
    protected $width = 1140;

    /**
     * Max Height of the image.
     *
     * @var int
     */
    protected $height = 400;

    /**
     * Class constructor.
     *
     * @param Image $image
     */
    public function __construct(Image $image)
    {
        $this->image = $image;
    }

    /**
     * Upload an image coming from Input
     * This method also "grab" the image, basically is resize and crop
     * the image to fit the best way.
     *
     * @param UploadedFile $uploadedImage
     *
     * @return ImageUploader
     */
    public function upload(UploadedFile $uploadedImage)
    {
        // save the image and generate its name based on current time
        $destinationFolder = public_path($this->getImageName());

        $this->uploadedImage = $this->image->make($uploadedImage->getRealPath())
            ->resize($this->width, $this->height)
            ->save($destinationFolder);

        return $this;
    }

    /**
     * Return the path to the image.
     *
     * @return string
     */
    public function getImagePath()
    {
        if (!$this->uploadedImage) {
            return '';
        }

        return $this->path.$this->uploadedImage->basename;
    }

    /**
     * Returns a name for a image based on time.
     *
     * @return string
     */
    private function getImageName()
    {
        return $this->path.time().'.jpg';
    }
}
