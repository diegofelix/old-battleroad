<?php namespace Champ\Championship;

use Eloquent;
use Champ\Traits\PriceAttribute;
use Laracasts\Presenter\PresentableTrait;
use Laracasts\Commander\Events\EventGenerator;
use Champ\Championship\Events\CouponWasApplied;

class Coupon extends Eloquent {

    protected $fillable = ['code', 'championship_id', 'price'];

    /**
     * Competition presenter
     *
     * @var string
     */
    protected $presenter = 'Champ\Presenters\CouponPresenter';

    use EventGenerator;
    use PriceAttribute;
    use PresentableTrait;

    /**
     * Generate a new coupon for the championship
     *
     * @param  int $championshipId
     * @param  string $code
     * @param  int $price
     * @return Model
     */
    public static function generate($championship_id, $code, $price)
    {
        return new static(compact('championship_id', 'code', 'price'));
    }

    /**
     * Apply the coupon for a user in a determined join
     *
     * @param  int $joinId
     * @param  int $userId
     * @return void
     */
    public function applyFor($joinId, $userId)
    {
        $this->join_id = $joinId;
        $this->user_id = $userId;

        $this->raise(new CouponWasApplied($this));
    }

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

    /**
     * Relation with Join
     *
     * @return BelongsTo
     */
    public function join()
    {
        return $this->belongsTo('Champ\Join\Join');
    }

}
