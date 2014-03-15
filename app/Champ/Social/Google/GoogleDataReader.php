<?php namespace Champ\Social\Google;

use OAuth;
use Champ\Social\SocialDataReaderInterface;

class GoogleDataReader implements SocialDataReaderInterface {

    /**
     * Google Data Formatter
     *
     * @var Champ\Social\Google\GoogleDataFormatter
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
        $data = $this->readDataFromGoogle($code);
        return $this->formatter->format($data);
    }

    /**
     * Read the data from Google
     *
     * @param  string $code
     * @return array
     */
    protected function readDataFromGoogle($code)
    {
        $googleService = OAuth::consumer('Google');
        $token = $googleService->requestAccessToken($code);
        return json_decode($googleService->request('https://www.googleapis.com/oauth2/v1/userinfo'), true);
    }

}