<?php

namespace Champ\Account;

use Eloquent;

class Achievement extends Eloquent
{
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['championship', 'competition.game'];

    /**
     * Relation with User.
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('Champ\Account\User');
    }

    /**
     * Relation with Championship.
     *
     * @return BelongsTo
     */
    public function championship()
    {
        return $this->belongsTo('Champ\Championship\Championship');
    }

    /**
     * Relation with Competition.
     *
     * @return BelongsTo
     */
    public function competition()
    {
        return $this->belongsTo('Champ\Championship\Competition');
    }
}
