<?php namespace Champ\Social\Google;

class GoogleDataFormatter
{
    /**
     * Format a data in order to mantain a default data to the consumer.
     *
     * @param array $data
     *
     * @return array
     */
    public function format($data)
    {
        return [
            'name' => $data['name'],
            'email' => $data['email'],
            'username' => usernameFromEmail($data['email']),
            'picture' => $data['picture'],
        ];
    }
}
