<?php namespace Champ\Join;

use Eloquent;

class Transaction extends Eloquent
{
    protected $guarded = [];

    /**
     * Relation with Status.
     *
     * @return BelongsTo
     */
    public function status()
    {
        return $this->belongsTo('Champ\Join\Status');
    }

    /**
     * Relation with Join.
     *
     * @return BelongsTo
     */
    public function join()
    {
        return $this->belongsTo('Champ\Join\Join');
    }
}
