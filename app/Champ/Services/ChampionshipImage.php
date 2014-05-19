<?php namespace Champ\Services;

class ChampionshipImage extends ImageUploader
{
    /**
     * Relative path to the images
     *
     * @var string
     */
    protected $path = '/images/championships/';

    /**
     * Max width of the image
     *
     * @var integer
     */
    protected $width = 1170;
    protected $thumbWidth = 300;

    /**
     * Max Height of the image
     *
     * @var integer
     */
    protected $height = 400;
    protected $thumbHeight = 150;

    /**
     * After the update, I need that you create a thumbnail
     * of that image so I can show in the champ list =)
     *
     * @param  mixed $image
     * @return void
     */
    public function afterUpload($image)
    {
        $dest = public_path($this->path . 'thumb_' . $image->filename . '.jpg');

        $this->image->make($image->dirname . '/' . $image->basename)
            ->grab($this->thumbWidth, $this->thumbHeight)
            ->save($dest);
    }

    /**
     * Get the thumb path
     *
     * @return string
     */
    public function getThumbPath()
    {
        return $this->path . 'thumb_' . $this->uploadedImage->basename;
    }
}