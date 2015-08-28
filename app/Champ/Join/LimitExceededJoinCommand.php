<?php

namespace Champ\Join;

class LimitExceededJoinCommand {

    public $championship_id;
    public $name;
    public $nicks;
    public $email;
    public $email_confirmation;
    public $identification;
    public $competitions;

    function __construct($championship_id, $name, $nicks, $email, $email_confirmation, $identification, $competitions = array()) {
        $this->championship_id = $championship_id;
        $this->competitions = $competitions;
        $this->name = $name;
        $this->nicks = $nicks;
        $this->email = $email;
        $this->email_confirmation = $email_confirmation;
        $this->identification = $identification;
    }

}