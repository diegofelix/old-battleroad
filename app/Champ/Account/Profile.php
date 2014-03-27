<?php namespace Champ\Account;

use Eloquent;

class Profile extends Eloquent {

    protected $fillable = ['user_id', 'bio', 'rg', 'cpf', 'phone', 'zipcode', 'address', 'number', 'complement', 'city', 'state'];

    /**
     * Relation with User
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('Champ\Account\User');
    }

    /**
     * Dates to be handled by the Carbon
     *
     * @return array
     */
    public function getDates()
    {
        return ['created_at', 'updated_at', 'birthday'];
    }

    /**
     * Change the date format before save the birthday
     *
     * @return void
     */
    public function setBirthdayAttribute($value)
    {
        $this->attributes['birthday'] = Carbon::createFromFormat('d/m/Y', $value)->toDateString();
    }

}