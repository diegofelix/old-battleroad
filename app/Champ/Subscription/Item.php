<?php namespace Champ\Subscription;

use Eloquent;

class Item extends Eloquent
{
    protected $guarded = [];

    public $timestamps = false;

    /**
     * Relation with Subscription
     *
     * @return  BelongsTo
     */
    public function subscription()
    {
        return $this->belongsTo('Subscription');
    }
}