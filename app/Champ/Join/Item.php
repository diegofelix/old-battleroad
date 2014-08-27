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

    /**
     * Convert the price to cents
     *
     * @param int $value
     */
    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = $value * 100;
    }

    /**
     * Get the price in cents and transforms to real
     *
     * @param  int $value
     * @return float
     */
    public function getPriceAttribute($value)
    {
        return $value / 100;
    }
}