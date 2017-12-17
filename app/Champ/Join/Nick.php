<?php

namespace Champ\Join;

use Illuminate\Database\Eloquent\Model;

class Nick extends Model
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
