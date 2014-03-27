<?php namespace Champ\Championship;

use Eloquent;

class Championship extends Eloquent {

    /**
     * Relation with User
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('Champ\Account\User');
    }

}