<?php namespace Champ\Billing\Contracts;

interface TransactionService
{
    /**
     * Get the details about a transaction by its id.
     *
     * @param int $id
     *
     * @return array
     */
    public function getDetails($id);
}
