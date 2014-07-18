<?php namespace Champ\Championship\Registration;

class RegisterChampionshipCommand {

    public $user_id;

    public $name;

    public $description;

    public $event_start;

    public $image;

    public function __construct($user_id, $name, $description, $event_start, $image = null)
    {
        $this->user_id = $user_id;
        $this->name = $name;
        $this->description = $description;
        $this->event_start = $event_start;
        $this->image = $image;
    }

}