<?php namespace Champ\Championship;

use Eloquent;
use Carbon\Carbon;

class Championship extends Eloquent {

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
     * Dates handled by Carbon
     *
     * @return array
     */
    public function getDates()
    {
        return ['created_at', 'updated_at', 'event_start', 'event_end', 'published_at'];
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
     * Convert the date to the db format
     *
     * @param string $value
     */
    public function setEventEndAttribute($value)
    {
        $this->attributes['event_end'] = $this->formatToDb($value);
    }

    /**
     * Convert the date given to the correct format
     *
     * @param  string $value date in format dd/mm/yyyy hh:ii:ss
     * @return string        date in format yyyy-mm--dd hh:ii:ss
     */
    protected function formatToDb($value)
    {
        return Carbon::createFromFormat('d/m/Y H:i:s', $value)->toDateTimeString();
    }

}