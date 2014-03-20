<?php namespace Champ\Account;

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use Eloquent;

class User extends Eloquent implements UserInterface, RemindableInterface {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password');

    /**
     * The user can add points to himself
     *
     * @var array
     */
    protected $guarded = array('points');

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Get the e-mail address where password reminders are sent.
     *
     * @return string
     */
    public function getReminderEmail()
    {
        return $this->email;
    }

    /**
     * Relation with championship
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function championships()
    {
        return $this->hasMany('Championship');
    }

    /**
     * Relation with profile
     *
     * @return Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile()
    {
        return $this->hasOne('Champ\Account\Profile');
    }

}