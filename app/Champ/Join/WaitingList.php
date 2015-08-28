<?php

namespace Champ\Join;

use Eloquent;

class WaitingList extends Eloquent
{
    protected $guarded = [];

    /**
     * Table for the model
     *
     * @var string
     */
    protected $table = "waiting_list";

    /**
     * Register a new user to a waiting list
     *
     * @param  int $userId
     * @param  int $championshipId
     * @param  int $competitionId
     * @return Model
     */
    public static function register($user_id, $championship_id, $competition_id)
    {
        return new static(compact('user_id', 'championship_id', 'competition_id'));
    }

    /**
     * Relation with Championship
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function championship()
    {
        return $this->belongsTo('Champ\Championship\Championship');
    }

    /**
     * Relation with User
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('Champ\Account\User');
    }
}