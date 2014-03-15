<?php namespace Champ\Social\Facebook;

use OAuth;

class FacebookDataReader {

    /**
     * Facebook Data Formatter
     *
     * @var Champ\Social\Facebook\FacebookDataFormatter
     */
    protected $formatter;

    public function __construct(GoogleDataFormatter $formatter)
    {
        $this->formatter = $formatter;
    }

    /**
     * Get the code and do an request back to google retrieving the user data.
     *
     * @param  string $code
     * @return array
     */
    public function getDataFromCode($code)
    {
        $data = $this->readDataFromFacebook($code);

        dd($data);


        return $this->formatter->format($data);
    }

    /**
     * Read the data from Facebook
     *
     * @param  string $code
     * @return array
     */
    private function readDataFromFacebook($code)
    {
        $facebookService = OAuth::consumer('Facebook');
        $token = $facebookService->requestAccessToken($code);
        return json_decode($facebookService->request('/me'), true);
    }

}