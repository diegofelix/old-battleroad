<?php

namespace Champ\Championship;

use Carbon\Carbon;
use Champ\Championship\Events\ChampionshipFinished;
use Champ\Championship\Events\ChampionshipPublished;
use Champ\Join\Status;
use Champ\Traits\FormatToDb;
use Illuminate\Database\Eloquent\Model;
use Laracasts\Commander\Events\EventGenerator;
use Laracasts\Presenter\PresentableTrait;

class Championship extends Model
{
    use EventGenerator;
    use FormatToDb;
    use PresentableTrait;

    /**
     * Championship presenter.
     *
     * @var string
     */
    protected $presenter = 'Champ\Presenters\ChampionshipPresenter';

    /**
     * Allow all other fields to be mass assigned.
     *
     * @var array
     */
    protected $guarded = ['_token', 'published', 'published_at'];

    /**
     * Register a championship.
     *
     * @param string $name
     * @param string $description
     * @param string $event_start
     * @param string $image
     * @param string $thumb
     *
     * @return Championship
     */
    public static function register($user_id, $name, $description, $location, $event_start, $image = null, $thumb = null)
    {
        return new static(compact('user_id', 'name', 'description', 'location', 'event_start', 'image', 'thumb'));
    }

    /**
     * Publish a Championship.
     *
     * @return Championship
     */
    public function publish()
    {
        $this->published = true;
        $this->published_at = date('Y-m-d H:i:s');

        $this->raise(new ChampionshipPublished($this));

        return $this;
    }

    /**
     * Update championship's information.
     *
     * @param string $name
     * @param string $description
     * @param string $stream
     */
    public function updateInformation($name, $description, $stream = '')
    {
        $this->name = $name;
        $this->description = $description;
        $this->stream = $stream;

        // raise a new event if needed.
    }

    /**
     * Check if the id given is the same as the championship.
     *
     * @param int $id
     *
     * @return bool =
     */
    public function isOwner($id)
    {
        return $this->user_id == $id;
    }

    /**
     * Updates the banner images.
     *
     * @param string $image
     * @param string $thumb
     */
    public function updateBanner($image, $thumb)
    {
        $this->image = $image;
        $this->thumb = $thumb;
    }

    /**
     * Get the closes competition for this championship.
     *
     * @return Competition
     */
    public function getClosestCompetition()
    {
        return $this->competitions()->orderBy('start')->first();
    }

    /**
     * Relation with User.
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('Champ\Account\User');
    }

    /**
     * Relation with joins.
     *
     * @return HasMany
     */
    public function joins()
    {
        return $this->hasMany('Champ\Join\Join');
    }

    /**
     * Relation with competition.
     *
     * @return HasMany
     */
    public function competitions()
    {
        return $this->hasMany('Champ\Championship\Competition');
    }

    /**
     * Relation with coupons.
     *
     * @return HasMany
     */
    public function coupons()
    {
        return $this->hasMany('Champ\Championship\Coupon');
    }

    /**
     * Relation with Waiting List.
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function waitingList()
    {
        return $this->hasMany('Champ\Join\WaitingList');
    }

    /**
     * Dates handled by Carbon.
     *
     * @return array
     */
    public function getDates()
    {
        return ['created_at', 'updated_at', 'event_start', 'published_at'];
    }

    /**
     * Convert the date to the db format.
     *
     * @param string $value
     */
    public function setEventStartAttribute($value)
    {
        $this->attributes['event_start'] = $this->formatToDb($value);
    }

    /**
     * Convert the price to cents.
     *
     * @param int $value
     */
    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = $value * 100;
    }

    /**
     * Convert the original price to cents.
     *
     * @param int $value
     */
    public function setOriginalPriceAttribute($value)
    {
        $this->attributes['original_price'] = $value * 100;
    }

    /**
     * Get the price in cents and transforms to real.
     *
     * @param int $value
     *
     * @return float
     */
    public function getPriceAttribute($value)
    {
        return $value / 100;
    }

    /**
     * Get the original price in cents and transforms to real.
     *
     * @param int $value
     *
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
     * Check if Championship was published.
     *
     * @param int $id
     *
     * @return bool
     */
    public static function checkPublished($id)
    {
        return 1 == self::find($id)->published;
    }

    /**
     * Check if Championship was finished.
     *
     * @param int $id
     *
     * @return bool
     */
    public static function checkFinished($id)
    {
        return 1 == self::find($id)->finished;
    }

    /**
     * Check if the user already has integrated with MercadoPago.
     *
     * @return bool
     */
    public function hasIntegrated()
    {
        return !empty($this->token);
    }

    /**
     * Check if the championship period is finished.
     *
     * @return bool
     */
    public function isFinished()
    {
        return true == $this->finished;
    }

    /**
     * Get a qty of competitors based on inportance.
     *
     * @param int $qty
     *
     * @return Collection
     */
    public function getFeaturedCompetitors($qty = 10)
    {
        return $this->joins()->whereStatusId(Status::APPROVED)->paginate($qty);
    }

    /**
     * Show all competitions that has vacancies.
     *
     * @return bool
     */
    public function hasAvailableCompetitions()
    {
        foreach ($this->competitions as $competition) {
            if ($competition->limit > 0) {
                return true;
            }
        }

        return false;
    }

    public function availableCompetitions()
    {
        return $this->competitions->filter(function ($competition) {
            return $competition->limit > 0;
        });
    }
}
