<?php

namespace Champ\Services;

use Intervention\Image\ImageManager as Image;

abstract class ImageUploader
{
    /**
     * Intervention Image.
     *
     * @var Intervention\Image\Facades\Image
     */
    protected $image;

    /**
     * The relative path to image.
     *
     * @var string
     */
    protected $path;

    /**
     * Size in pixels.
     *
     * @var int
     */
    protected $width;

    /**
     * Size in pixels.
     *
     * @var int
     */
    protected $height;

    /**
     * The uploaded image.
     *
     * @var Intervention/Image
     */
    protected $uploadedImage;

    /**
     * Inject the intervention.
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
     * @param array $input
     *
     * @return Intervention\Image\Facades\Image
     */
    public function upload($input)
    {
        // save the image and generate its name based on current time
        $dest = public_path($this->path.time().'.jpg');

        $this->uploadedImage = $this->image->make($input->getRealPath())
            ->resize($this->width, $this->height)
            ->save($dest);

        // hook to make another modification in the current image
        $this->afterUpload($this->uploadedImage);

        return $this;
    }

    /**
     * Return the path to the image.
     *
     * @return string
     */
    public function getImagePath()
    {
        return $this->path.$this->uploadedImage->basename;
    }

    /**
     * This is a hook method to do some other stufss after
     * the main image is save on file.
     */
    public function afterUpload($image)
    {
    }
}
