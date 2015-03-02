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
}