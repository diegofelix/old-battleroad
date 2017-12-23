<?php

namespace Champ\Account;

use Auth;
use Carbon\Carbon;
use Champ\Join\Status;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Notifications\Notifiable;
use Laracasts\Presenter\PresentableTrait;

class User extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, Notifiable;
    use PresentableTrait;

    /**
     * Championship presenter.
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
     * All fields below can be mass assigned.
     *
     * @var array
     */
    protected $fillable = ['name', 'username', 'email', 'password', 'picture'];

    public function register($data)
    {
        $user = $this->fill($data);

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
     * Relation with championship.
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function championships()
    {
        return $this->hasMany('Champ\Championship\Championship');
    }

    /**
     * Relation with profile.
     *
     * @return Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile()
    {
        return $this->hasOne('Champ\Account\Profile');
    }

    /**
     * Relation with Join.
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function joins()
    {
        return $this->hasMany('Champ\Join\Join');
    }

    /**
     * Relation with coupons.
     *
     * @return HasMany
     */
    public function coupons()
    {
        return $this->hasMany('Champ\Championship\Coupon');
    }

    /**
     * Relation with Achievement.
     *
     * @return HasMany
     */
    public function achievements()
    {
        return $this->hasMany('Champ\Account\Achievement');
    }

    /**
     * Get the latest by the id.
     *
     * @param  $id
     *
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
     * Check if the authenticated user is the same as requested.
     *
     * @return bool
     */
    public function currentUser()
    {
        if (Auth::guest()) {
            return false;
        }

        return $this->id == Auth::user()->id;
    }

    /**
     * Check if the user is a organizer.
     *
     * @return bool
     */
    public function isOrganizer()
    {
        return true == $this->is_organizer;
    }

    /**
     * Dates handled by the Carbon Api.
     *
     * @return array
     */
    public function getDates()
    {
        return ['created_at', 'updated_at', 'birthdate'];
    }

    /**
     * Convert the brazilian date do database date.
     *
     * @param string $value
     */
    public function setBirthdateAttribute($value)
    {
        $this->attributes['birthdate'] = Carbon::createFromFormat('d/m/Y', $value)->toDateString();
    }
}
