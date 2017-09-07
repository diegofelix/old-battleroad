<?php

namespace Champ\Presenters;

use Laracasts\Presenter\Presenter;

class UserPresenter extends Presenter
{
    /**
     * Show the user image for the user
     * if he does not have an image we provide an gravatar image
     * this way he can change your picture later.
     *
     * @return string
     */
    public function userImage()
    {
        if (!$this->picture) {
            return 'http://www.gravatar.com/avatar/'.md5($this->email);
        }

        return $this->picture;
    }

    /**
     * Present the User Birthdate with the Brazilian format.
     *
     * @return string
     */
    public function userBirthdate()
    {
        if ($this->birthdate) {
            return $this->birthdate->format('d/m/Y');
        }

        return '';
    }
}
