<?php namespace Champ\Championship;

use Eloquent;
use Carbon\Carbon;
use Laracasts\Presenter\PresentableTrait;

class Championship extends Eloquent
{
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
    public static function register($user_id, $name, $description, $event_start, $image = null, $thumb = null)
    {
       return new static(compact('user_id', 'name', 'description', 'event_start', 'image', 'thumb'));
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
     * Check if Championship was published
     *
     * @param  int $id
     * @return boolean
     */
    public static function checkPublished($id)
    {
        return self::find($id)->published == 1;
    }

    use \Champ\Traits\FormatToDb;

}