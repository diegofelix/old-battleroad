<?php namespace Champ\Account;

use Eloquent;

class Profile extends Eloquent {

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