<?php namespace Champ\Subscription;

use Eloquent;

class Subscription extends Eloquent
{
    protected $guarded = [];

    /**
     * Relation with User
     */
    public function user()
    {
        return $this->belongsTo('User');
    }

    /**
     * Relation with Championship
     */
    public function championship()
    {
        return $this->belongsTo('Championship');
    }

    /**
     * Relation with Item
     * @return HasMany
     */
    public function items()
    {
        return $this->hasMany('Item');
    }

    /**
     * Create a new Subscription
     *
     * @param  int $user_id
     * @param  int $championship_id
     * @return Subscription
     */
    public static function register($user_id, $championship_id, $price)
    {
        return new static(compact('user_id', 'championship_id', 'price'));
    }

    /**
     * Add an item to the subscription
     *
     * @param int $competitionId
     * @param int $price
     */
    public function addItem($competitionId, $price)
    {
        return new Item([
            'subscription_id' => $this->id,
            'competition_id' => $competitionId,
            'price' => $price
        ]);
    }
}