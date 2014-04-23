<?php namespace Champ\Championship;

use Eloquent;

class Competition extends Eloquent
{
    /**
     * Relation with Championship
     *
     * @return BelongsTo
     */
    public function championship()
    {
        return $this->belongsTo('Champ\Championship\Championship');
    }
    /**
     * Relation with Format
     *
     * @return BelongsTo
     */
    public function format()
    {
        return $this->belongsTo('Champ\Championship\Format');
    }

    /**
     * Relation with Game
     *
     * @return BelongsTo
     */
    public function game()
    {
        return $this->belongsTo('Champ\Championship\Game');
    }

    /**
     * Relation with Platform
     *
     * @return BelongsTo
     */
    public function platform()
    {
        return $this->belongsTo('Champ\Championship\Platform');
    }
}
