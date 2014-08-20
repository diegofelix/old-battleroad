<?php namespace Champ\Join;

use Eloquent;

class Status extends Eloquent
{
    protected $table = 'statuses';

    /**
     * Relation with Join
     *
     * @param  HasMany
     */
    public function joins()
    {
        return $this->HasMany('Champ\Join\Join');
    }
}