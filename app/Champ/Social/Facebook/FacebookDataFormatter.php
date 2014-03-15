<?php namespace Champ\Social\Facebook;

class FacebookDataFormatter {

    /**
     * Format a data in order to mantain a default data to the consumer
     *
     * @param array $data
     * @return array
     */
    public function format($data)
    {
        return [
            'name' => $data['name'],
            'email' => $data['email'],
            'username' => $data['username'],
            'picture' => "http://graph.facebook.com/{$data['id']}/picture"
        ];
    }

}