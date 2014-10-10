<?php namespace Champ\Championship;

use Eloquent;
use Carbon\Carbon;
use Laracasts\Presenter\PresentableTrait;
use Champ\Traits\FormatToDb;

class Championship extends Eloquent
{
    use PresentableTrait;
    use FormatToDb;

    /**
     * Championship presenter
     *
     * @var string
     */
    protected $presenter = 'Champ\Presenters\ChampionshipPresenter';

    /**
     * Allow all other fields to be mass assigned
     *
     * @var array
     */
    protected $guarded = ['_token', 'published', 'published_at'];

    /**
     * Register a championship
     *
     * @param  string $name
     * @param  string $description
     * @param  string $event_start
     * @param  string $image
     * @param  string $thumb
     * @return Championship
     */
    public static function register($user_id, $name, $description, $event_start, $location, $image = null, $thumb = null, $limit = null)
    {
       return new static(compact('user_id', 'name', 'description', 'event_start', 'location', 'image', 'thumb', 'limit'));
    }

    /**
     * Relation with User
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('Champ\Account\User');
    }

    /**
     * Relation with joins
     *
     * @return HasMany
     */
    public function joins()
    {
        return $this->hasMany('Champ\Join\Join');
    }

    /**
     * Relation with competition
     *
     * @return HasMany
     */
    public function competitions()
    {
        return $this->hasMany('Champ\Championship\Competition');
    }

    /**
     * Dates handled by Carbon
     *
     * @return array
     */
    public function getDates()
    {
        return ['created_at', 'updated_at', 'event_start', 'published_at'];
    }

    /**
     * Convert the date to the db format
     *
     * @param string $value
     */
    public function setEventStartAttribute($value)
    {
        $this->attributes['event_start'] = $this->formatToDb($value);
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
     * Convert the original price to cents
     *
     * @param int $value
     */
    public function setOriginalPriceAttribute($value)
    {
        $this->attributes['original_price'] = $value * 100;
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
     * Check if Championship was published
     *
     * @param  int $id
     * @return boolean
     */
    public static function checkPublished($id)
    {
        return self::find($id)->published == 1;
    }

    /**
     * Set the the limit attribute
     * If the limit was not specified, then we set a high number to ensure that
     * this limit will not be reach
     *
     * @param int $value
     */
    public function setLimitAttribute($value)
    {
        $this->attributes['limit'] = $value;

        if (empty($value) || $value == 0)
        {
            $this->attributes['limit'] = 999999;
        }
    }

    /**
     * Check if the user already has integrated with MercadoPago
     *
     * @return boolean
     */
    public function hasIntegrated()
    {
        return !empty($this->refresh_token);
    }

}