<?php namespace Champ\Championship\Registration;

class RegisterChampionshipCommand {

    public $user_id;

    public $name;

    public $description;

    public $event_start;

    public $image;

    public $location;

    public $limit;

    public function __construct($user_id, $name, $description, $event_start, $location, $image = null, $limit = null)
    {
        $this->user_id      = $user_id;
        $this->name         = $name;
        $this->description  = $description;
        $this->event_start  = $event_start;
        $this->location     = $location;
        $this->image        = $image;
        $this->limit        = $limit;
    }

}