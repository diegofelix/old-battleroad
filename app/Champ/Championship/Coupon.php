<?php namespace Champ\Championship;

use Eloquent;
use Champ\Traits\PriceAttribute;
use Laracasts\Presenter\PresentableTrait;

class Coupon extends Eloquent {

    protected $fillable = ['code', 'championship_id', 'price'];

    /**
     * Competition presenter
     *
     * @var string
     */
    protected $presenter = 'Champ\Presenters\CouponPresenter';

    use PriceAttribute;
    use PresentableTrait;

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
     * Relation with User
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('Champ\Account\User');
    }

}
