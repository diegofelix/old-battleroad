<?php

namespace Champ\Join;

class EmbededJoinCommand {

    public $name;
    public $username;
    public $email;
    public $identification;

    function __construct($name, $username, $email, $identification) {
        $this->name = $name;
        $this->username = $username;
        $this->email = $email;
        $this->identification = $identification;
    }

}