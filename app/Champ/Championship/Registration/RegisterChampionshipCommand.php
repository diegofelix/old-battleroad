<?php namespace Champ\Championship\Registration;

class RegisterChampionshipCommand {

    public $user_id;

    public $name;

    public $description;

    public $image;

    public $location;

    public $limit;

    public function __construct($user_id, $name, $description, $location, $image = null, $limit = null)
    {
        $this->user_id      = $user_id;
        $this->name         = $name;
        $this->description  = $description;
        $this->location     = $location;
        $this->image        = $image;
        $this->limit        = $limit;
    }

}