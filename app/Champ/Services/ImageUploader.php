<?php namespace Champ\Services;

use Intervention\Image\Facades\Image;

abstract ImageUploader {

    /**
     * Intervention Image
     *
     * @var Intervention\Image\Facades\Image
     */
    protected $image;

    /**
     * Inject the intervention
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
     * the image to fit the best way
     *
     * @param  array $input
     * @return Intervention\Image\Facades\Image
     */
    public function upload($input, $width, $height, $path)
    {
        // save the image and generate its name based on current time
        $dest = $path . time() . '.jpg';

        return $this->image->make($input->getRealPath())
            ->grab($width, $height)
            ->save($dest);
    }

}