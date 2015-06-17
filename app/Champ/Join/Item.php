<?php namespace Champ\Join;

use Eloquent;
use Laracasts\Presenter\PresentableTrait;
use Champ\Traits\PriceAttribute;

class Item extends Eloquent
{
    use PresentableTrait;
    use PriceAttribute;

    protected $guarded = [];

    public $timestamps = false;

    /**
     * Championship presenter
     *
     * @var string
     */
    protected $presenter = 'Champ\Presenters\ItemPresenter';

    /**
     * Relation with Join
     *
     * @return  BelongsTo
     */
    public function join()
    {
        return $this->belongsTo('Champ\Join\Join');
    }

    /**
     * Relation with Competition
     *
     * @return BelongsTo
     */
    public function competition()
    {
        return $this->belongsTo('Champ\Championship\Competition');
    }

    /**
     * Relation with Nick
     *
     * @return HasMany
     */
    public function nicks()
    {
        return $this->hasMany('Champ\Join\Nick');
    }

    /**
     * Add a new item
     *
     * @param  int $join_id
     * @param  int $price
     * @return model
     */
    public static function register($competition_id, $price)
    {
        return new static(compact('competition_id', 'price'));
    }
}