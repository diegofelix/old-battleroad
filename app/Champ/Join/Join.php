<?php namespace Champ\Join;

use Eloquent;
use Laracasts\Commander\Events\EventGenerator;
use Champ\Join\Events\UserJoined;

class Join extends Eloquent
{
    protected $guarded = [];

    use EventGenerator;

    /**
     * Relation with User
     */
    public function user()
    {
        return $this->belongsTo('Champ\Account\User');
    }

    /**
     * Relation with Championship
     */
    public function championship()
    {
        return $this->belongsTo('Champ\Championship\Championship');
    }

    /**
     * Relation with Item
     * @return HasMany
     */
    public function items()
    {
        return $this->hasMany('Champ\Join\Item');
    }

    /**
     * Relation with Status
     *
     * @return BelongsTo
     */
    public function status()
    {
        return $this->belongsTo('Champ\Join\Status');
    }

    /**
     * Create a new Join
     *
     * @param  int $user_id
     * @param  int $championship_id
     * @return Join
     */
    public static function register($user_id, $championship_id, $price)
    {
        $status_id = 2; // Initiated
        $join = new static(compact('user_id', 'championship_id', 'price', 'status_id'));

        $join->raise(new UserJoined($join));

        return $join;
    }

    /**
     * Add an item to the Join
     *
     * @param int $competitionId
     * @param int $price
     */
    public function addItem($competitionId, $price)
    {
        return new Item([
            'join_id' => $this->id,
            'competition_id' => $competitionId,
            'price' => $price
        ]);
    }
}