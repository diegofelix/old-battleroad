<?php namespace Champ\Join;

use Carbon\Carbon;
use Champ\Join\Events\JoinApproved;
use Champ\Join\Events\JoinCancelled;
use Champ\Join\Events\JoinStatusChanged;
use Champ\Join\Events\UserJoined;
use Eloquent;
use Event;
use Laracasts\Commander\Events\EventGenerator;
use Laracasts\Presenter\PresentableTrait;

class Join extends Eloquent {

    protected $guarded = [];

    use PresentableTrait;
    use EventGenerator;

    /**
     * Championship presenter
     *
     * @var string
     */
    protected $presenter = 'Champ\Presenters\JoinPresenter';

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
     * Relation with Transaction
     *
     * @return HasMany
     */
    public function transactions()
    {
        return $this->hasMany('Champ\Join\Transaction');
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
        $status_id = 1; // Waiting payment

        $join = new static(compact('user_id', 'championship_id', 'price', 'status_id'));

        $join->raise(new UserJoined($join));

        return $join;
    }

    /**
     * Change the Status for this order.
     *
     * @param  int $statusId
     * @param  string $token
     * @return void
     */
    public function changeStatus($statusId)
    {
        $this->status_id = $statusId;

        $this->raise(new JoinStatusChanged($this));

        if ($statusId == Status::APPROVED)
        {
            $this->raise(new JoinApproved($this));
        }

        if ($statusId >= Status::RETURNED) // Cancelled, Returned and chargeback
        {
            $this->raise(new JoinCancelled($this));
        }
    }


    /**
     * Cancel a Join
     *
     * @return void
     */
    public function cancelJoin()
    {
        $this->status_id = Status::CANCELLED;
        $this->save();

        Event::fire('join.cancelled', [$this]);
    }

    /**
     * Check if the championship was paid yet
     *
     * @return boolean
     */
    public function isPaid()
    {
        return  in_array($this->status_id, [Status::APPROVED, Status::FINISHED]);
    }

    /**
     * Convert the price to cents
     *
     * @param int $value
     */
    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = $value * 100;
    }

    /**
     * Get the price in cents and transforms to real
     *
     * @param  int $value
     * @return float
     */
    public function getPriceAttribute($value)
    {
        return $value / 100;
    }

    /**
     * Check if the user joined a free championship or not
     *
     * @return boolean
     */
    public function isFree()
    {
        if ( ! empty($this->price)) return false;

        foreach ($this->items as $item)
        {
            if ( ! empty($item->price)) return false;
        }

        return true;
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

    /**
     * Add a transaction that belongs to a join
     *
     * @param int $transactionId
     */
    public function addTransaction($transactionId)
    {
        $transaction = $this->findTransaction($transactionId);

        if (empty($transaction))
        {
            $transaction = new Transaction(['transaction_id' => $transactionId]);
            $this->transactions()->save($transaction);
        }
    }

    /**
     * Find a transaction by its Id
     *
     * @param  int $transactionId
     * @return Transaction
     */
    public function findTransaction($transactionId)
    {
        return $this->transactions()->where('transaction_id', $transactionId)->first();
    }

    /**
     * Check if the championship will start in 2 days
     *
     * @return boolean
     */
    public function inGracePeriod()
    {
        return $this->championship->event_start->diffInDays(Carbon::now()) <= 2;
    }
}