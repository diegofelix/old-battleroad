<?php namespace Champ\Championship;

use Eloquent;
use Carbon\Carbon;

class Championship extends Eloquent {

    /**
     * Championship presenter
     *
     * @var string
     */
    public $presenter = 'Champ\Presenters\Championship';

    /**
     * Allow all other fields to be mass assigned
     *
     * @var array
     */
    protected $guarded = ['_token', 'published', 'published_at'];

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

    use \Champ\Traits\FormatToDb;

}