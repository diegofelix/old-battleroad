<?php namespace Champ\Championship;

use Eloquent;
use Laracasts\Presenter\PresentableTrait;

class Competition extends Eloquent
{
    use PresentableTrait;

    /**
     * Allow all other fields to be mass assigned
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Competition presenter
     *
     * @var string
     */
    protected $presenter = 'Champ\Presenters\CompetitionPresenter';

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

    /**
     * Relation with Item in Join
     *
     * @return HasMany
     */
    public function items()
    {
        return $this->hasMany('Champ\Join\Item');
    }

    /**
     * Dates handles by Carbon\Carbon
     *
     * @return array
     */
    public function getDates()
    {
        return ['created_at', 'updated_at', 'start'];
    }

    public function setStartAttribute($value)
    {
        $this->attributes['start'] = $this->formatToDb($value);
    }

    public function getStartAttribute($value)
    {
        return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('d/m/Y');
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

    /**
     * Convert the original price to cents
     *
     * @param int $value
     */
    public function setOriginalPriceAttribute($value)
    {
        $this->attributes['original_price'] = $value * 100;
    }

    /**
     * Get the original price in cents and transforms to real
     *
     * @param  int $value
     * @return float
     */
    public function getOriginalPriceAttribute($value)
    {
        return $value / 100;
    }

    /**
     * Set the the limit attribute
     * If the limit was not specified, then we set a high number to ensure that
     * this limit will not be reach
     *
     * @param int $value
     */
    /*public function setLimitAttribute($value)
    {
        $this->attributes['limit'] = $value;

        if (empty($value) || $value == 0)
        {
            $this->attributes['limit'] = 999999;
        }
    }*/


    use \Champ\Traits\FormatToDb;
}
