<?php namespace Champ\Championship;

class UpdateChampionshipCommand {

    public $id;
    public $name;
    public $description;
    public $stream;

    public function __construct($id, $name, $description, $stream = "")
    {
        $this->id = $id;
        $this->name  = $name;
        $this->description  = $description;
        $this->stream  = $stream;
    }

}