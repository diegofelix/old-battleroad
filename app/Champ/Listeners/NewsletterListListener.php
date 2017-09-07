<?php

namespace Champ\Listeners;

use Laracasts\Commander\Events\EventListener;
use Champ\Account\Events\UserSignedUp;
use Champ\Account\Events\UserChangedProfile;
use Champ\Newsletters\NewsletterList;

class NewsletterListListener extends EventListener
{
    /**
     * Newsletter list.
     *
     * @var NewsletterList
     */
    protected $newsletterList;

    /**
     * @param NewsletterList $newsletterList
     */
    public function __construct(NewsletterList $newsletterList)
    {
        $this->newsletterList = $newsletterList;
    }

    /**
     * When user Signed Up for the Battleroad. Automatically
     * Subscribe him to the Newsletter list.
     *
     * @param UserSignedUp $event
     *
     * @return mixed
     */
    public function whenUserSignedUp(UserSignedUp $event)
    {
        $this->newsletterList->subscribeTo('championshipsSubscribers', $event->user->email);
    }

    /**
     * Subscribe or Unsubscribe a user from the Championships List.
     *
     * @param UserChangedProfile $event
     *
     * @return mixed
     */
    public function whenUserChangedProfile(UserChangedProfile $event)
    {
        $method = ($event->profile->notify) ? 'subscribeTo' : 'unsubscribeFrom';

        $this->newsletterList->{$method}('championshipsSubscribers', $event->profile->user->email);
    }
}
