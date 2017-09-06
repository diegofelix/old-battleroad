<?php
namespace Champ\Join;

use Eloquent;

class Nick extends Eloquent
{
    protected $guarded = [];

    /**
     * Relation with Item.
     *
     * @return BelongsTo
     */
    public function item()
    {
        return $this->belongsTo('Champ\Join\Item');
    }

    /**
     * Add a new item.
     *
     * @param  string nick
     *
     * @return model
     */
    public static function register($nick)
    {
        return new static(compact('nick'));
    }
}
