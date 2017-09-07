<?php

namespace Champ\Social\Facebook;

use OAuth;
use Champ\Social\SocialDataReaderInterface;

class FacebookDataReader implements SocialDataReaderInterface
{
    /**
     * Facebook Data Formatter.
     *
     * @var Champ\Social\Facebook\FacebookDataFormatter
     */
    protected $formatter;

    public function __construct(FacebookDataFormatter $formatter)
    {
        $this->formatter = $formatter;
    }

    /**
     * Get the code and do an request back to facebook retrieving the user data.
     *
     * @param string $code
     *
     * @return array
     */
    public function getDataFromCode($code)
    {
        $data = $this->readDataFromFacebook($code);

        return $this->formatter->format($data);
    }

    /**
     * Read the data from Facebook.
     *
     * @param string $code
     *
     * @return array
     */
    private function readDataFromFacebook($code)
    {
        $facebookService = OAuth::consumer('Facebook');
        $token = $facebookService->requestAccessToken($code);

        return json_decode($facebookService->request('/me'), true);
    }
}
