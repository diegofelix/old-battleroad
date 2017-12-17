<?php

namespace Champ\Join;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Champ\Traits\PriceAttribute;

class Item extends Model
{
    use PresentableTrait;
    use PriceAttribute;

    protected $guarded = [];

    public $timestamps = false;

    /**
     * Championship presenter.
     *
     * @var string
     */
    protected $presenter = 'Champ\Presenters\ItemPresenter';

    /**
     * Relation with Join.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function join()
    {
        return $this->belongsTo('Champ\Join\Join');
    }

    /**
     * Relation with Competition.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function competition()
    {
        return $this->belongsTo('Champ\Championship\Competition');
    }

    /**
     * Relation with Nick.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function nicks()
    {
        return $this->hasMany('Champ\Join\Nick');
    }

    /**
     * Add a new item.
     *
     * @param int    $competition_id
     * @param int    $price
     * @param string $team_name
     *
     * @return model
     */
    public static function register($competition_id, $price, $team_name = null)
    {
        return new static(compact('competition_id', 'price', 'team_name'));
    }
}
