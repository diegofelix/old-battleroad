<?php namespace Champ\Championship;

use Eloquent;
use Carbon\Carbon;
use Laracasts\Presenter\PresentableTrait;
use Champ\Traits\FormatToDb;
use Champ\Join\Status;
use Laracasts\Commander\Events\EventGenerator;
use Champ\Championship\Events\ChampionshipFinished;
use Champ\Championship\Events\ChampionshipPublished;

class Championship extends Eloquent
{
    use EventGenerator;
    use FormatToDb;
    use PresentableTrait;

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
    public static function register($user_id, $name, $description, $location, $event_start, $image = null, $thumb = null)
    {
        return new static(compact('user_id', 'name', 'description', 'location', 'event_start', 'image', 'thumb'));
    }

    /**
     * Publish a Championship
     *
     * @return Championship
     */
    public function publish()
    {
        $this->published = true;
        $this->published_at = Date('Y-m-d H:i:s');

        $this->raise(new ChampionshipPublished($this));

        return $this;
    }

    /**
     * Update championship's information
     *
     * @param  string $name
     * @param  string $description
     * @return void
     */
    public function updateInformation($name, $description)
    {
        $this->name = $name;
        $this->description = $description;

        // raise a new event if needed.
    }

    /**
     * Check if the id given is the same as the championship
     *
     * @param  int $id
     * @return boolean     =
     */
    public function isOwner($id)
    {
        return $this->user_id == $id;
    }

    /**
     * Updates the banner images
     *
     * @param  string $image
     * @param  string $thumb
     * @return void
     */
    public function updateBanner($image, $thumb)
    {
        $this->image = $image;
        $this->thumb = $thumb;

        // raise a new event if needed
    }


    /**
     * Get the closes competition for this championship
     *
     * @return Competition
     */
    public function getClosestCompetition()
    {
        return $this->competitions()->orderBy('start')->first();
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

    public function finishChampionship()
    {
        $this->finished = true;
        $this->save();
        $this->raise(new ChampionshipFinished($this));
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
     * Check if Championship was finished
     *
     * @param  int $id
     * @return boolean
     */
    public static function checkFinished($id)
    {
        return self::find($id)->finished == 1;
    }

    /**
     * Check if the user already has integrated with MercadoPago
     *
     * @return boolean
     */
    public function hasIntegrated()
    {
        return !empty($this->token);
    }

    /**
     * Check if the championship period is finished
     *
     * @return boolean
     */
    public function isFinished()
    {
        return $this->finished == true;
    }

    /**
     * Get a qty of competitors based on inportance
     *
     * @param  int $qty
     * @return Collection
     */
    public function getFeaturedCompetitors($qty = 10)
    {
        return $this->joins()->whereStatusId(Status::APPROVED)->limit($qty)->get();
    }

}