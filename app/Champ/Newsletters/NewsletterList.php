<?php namespace Champ\Newsletters;

interface NewsletterList
{
    /**
     * Subscribe a email to a list.
     *
     * @param strgin $listName
     * @param string $email
     *
     * @return mixed
     */
    public function subscribeTo($listName, $email);

    /**
     * Unsubscribe a user from a list.
     *
     * @param string $listName
     * @param string $email
     *
     * @return mixed
     */
    public function unsubscribeFrom($listName, $email);
}
