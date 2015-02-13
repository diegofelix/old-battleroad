<?php namespace Champ\Championship;

use Eloquent;

class Coupon extends Eloquent {

    protected $fillable = ['code', 'championship_id'];

    /**
     * Relation with Championship
     *
     * @return BelongsTo
     */
    public function championship()
    {
        return $this->belongsTo('Champ\Championship\Championship');
    }

}
