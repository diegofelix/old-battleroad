<?php namespace Champ\Traits;

trait PriceAttribute {

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