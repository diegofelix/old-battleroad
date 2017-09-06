<?php namespace Champ\Newsletters\Mailchimp;

use Champ\Newsletters\NewsletterList as NewsletterListInterface;
use Mailchimp;

class NewsletterList implements NewsletterListInterface
{
    protected $lists = [
        'championshipsSubscribers' => '4d9ee789f6',
    ];

    /**
     * Mailchimp.
     *
     * @var Mailchimp
     */
    protected $mailchimp;

    public function __construct(Mailchimp $mailchimp)
    {
        $this->mailchimp = $mailchimp;
    }

    /**
     * Subscribe a user to Mailchimp list.
     *
     * @param strgin $listName
     * @param string $email
     *
     * @return mixed
     */
    public function subscribeTo($listName, $email)
    {
        return $this->mailchimp->lists->subscribe(
            getenv('CHAMPIONSHIPS_SUBSCRIBERS_LIST'),
            compact('email'),
            null, // merge vars
            'html', // type
            false, // require double opt in?
            true // update existing customers?
        );
    }

    /**
     * Unsubscribe a user from a Mailchimp list.
     *
     * @param string $listName
     * @param string $email
     *
     * @return mixed
     */
    public function unsubscribeFrom($listName, $email)
    {
        return $this->mailchimp->lists->unsubscribe(
            $this->lists[$listName],
            compact('email'),
            false, // delete the member permanently
            false, // send goodby email,
            false // send unsubscribe notification email?
        );
    }
}
