<?php

namespace Champ\Join;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
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
