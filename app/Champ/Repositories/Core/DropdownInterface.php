<?php namespace Champ\Repositories\Core;

interface DropdownInterface {

    /**
     * Get a list of games
     *
     * @param  int $champId
     * @return array
     */
    public function dropdown();

}