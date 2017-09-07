<?php

namespace Champ\Championship;

class UpdateBannerCommand
{
    public $id;
    public $image;

    public function __construct($id, $image)
    {
        $this->id = $id;
        $this->image = $image;
    }
}
