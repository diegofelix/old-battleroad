<?php namespace Champ\Account;

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use Laracasts\Commander\Events\EventGenerator;
use Laracasts\Presenter\PresentableTrait;
use Champ\Account\Events\UserSignedUp;
use Champ\Join\Status;
use Eloquent;
use Auth;
use Hash;

class User extends Eloquent implements UserInterface, RemindableInterface
{

    /**
     * Championship presenter
     *
     * @var string
     */
    protected $presenter = 'Champ\Presenters\UserPresenter';

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
     * All fields below can be mass assigned
     *
     * @var array
     */
    protected $fillable = ['name', 'username', 'email', 'password', 'picture'];

    use PresentableTrait;
    use EventGenerator;

    public function register($data)
    {
        $user = $this->fill($data);

        $this->raise(new UserSignedUp($user));

        return $user;
    }

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

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    /**
     * Relation with championship
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function championships()
    {
        return $this->hasMany('Champ\Championship\Championship');
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

    /**
     * Relation with Join
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function joins()
    {
        return $this->hasMany('Champ\Join\Join');
    }

    /**
     * Relation with coupons
     *
     * @return HasMany
     */
    public function coupons()
    {
        return $this->hasMany('Champ\Championship\Coupon');
    }

    /**
     * Get the latest by the id
     *
     * @param  $id
     * @return Join
     */
    public function getJoin($id)
    {
        return $this->joins()
                ->where('championship_id', $id)
                ->whereNotIn('status_id', [Status::RETURNED, Status::CANCELLED, Status::CHARGEBACK])
                ->first();
    }

    /**
     * Check if the authenticated user is the same as requested
     *
     * @return boolean
     */
    public function currentUser()
    {
        if (Auth::guest()) return false;

        return $this->id == Auth::user()->id;
    }

    /**
     * Check if the user is a organizer
     *
     * @return boolean
     */
    public function isOrganizer()
    {
        return $this->is_organizer == true;
    }

}