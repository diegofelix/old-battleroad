<?php namespace Champ\Join;

use Eloquent;

class Status extends Eloquent
{
    protected $table = 'statuses';

    const WAITING       = 1;
    const IN_PROGRESS   = 2;
    const APPROVED      = 3;
    const FINISHED      = 4;
    const DISPUTE       = 5;
    const RETURNED      = 6;
    const CANCELLED     = 7;
    const CHARGEBACK    = 8;

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