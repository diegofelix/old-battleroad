<?php

namespace Champ\Join;

class EmbededJoinCommand {

    public $championship_id;
    public $competitions;
    public $name;
    public $nicks;
    public $email;
    public $identification;

    function __construct($championship_id, $competitions, $name, $nicks, $email, $identification) {
        $this->championship_id = $championship_id;
        $this->competitions = $competitions;
        $this->name = $name;
        $this->nicks = $nicks;
        $this->email = $email;
        $this->identification = $identification;
    }

}