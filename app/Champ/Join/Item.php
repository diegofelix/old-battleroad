<?php namespace Champ\Join;

use Eloquent;

class Item extends Eloquent
{
    protected $guarded = [];

    public $timestamps = false;

    /**
     * Relation with Join
     *
     * @return  BelongsTo
     */
    public function join()
    {
        return $this->belongsTo('Champ\Join\Join');
    }

    /**
     * Relation with Competition
     *
     * @return BelongsTo
     */
    public function competition()
    {
        return $this->belongsTo('Champ\Championship\Competition');
    }
}