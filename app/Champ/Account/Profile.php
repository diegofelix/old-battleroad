<?php

namespace Champ\Account;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['user_id', 'bio', 'psn', 'live', 'steam', 'notify'];

    /**
     * Create a new profile.
     *
     * @param array $data
     *
     * @return Profile
     */
    public static function createProfile($data)
    {
        if (!isset($data['notify'])) {
            $data['notify'] = false;
        }

        $profile = new static($data);

        return $profile;
    }

    /**
     * Update the profile with the new data.
     *
     * @param array $data
     *
     * @return Profile
     */
    public function updateProfile($data)
    {
        if (!isset($data['notify'])) {
            $data['notify'] = false;
        }

        $profile = $this->fill($data);

        return $profile;
    }

    /**
     * Relation with User.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('Champ\Account\User');
    }

    /**
     * Dates to be handled by the Carbon.
     *
     * @return array
     */
    public function getDates()
    {
        return ['created_at', 'updated_at', 'birthday'];
    }

    /**
     * Change the date format before save the birthday.
     */
    public function setBirthdayAttribute($value)
    {
        $this->attributes['birthday'] = Carbon::createFromFormat('d/m/Y', $value)->toDateString();
    }
}
