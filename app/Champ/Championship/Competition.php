<?php namespace Champ\Championship;

use Eloquent;

class Competition extends Eloquent
{
    /**
     * Allow all other fields to be mass assigned
     *
     * @var array
     */
    protected $guarded = ['id'];

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



    use \Champ\Traits\FormatToDb;
}
