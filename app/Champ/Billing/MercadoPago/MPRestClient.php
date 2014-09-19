<?php namespace Champ\Billing\MercadoPago;

class MPRestClient {

    private $version = "0.2.1";

    /**
     * Base url for the mercadolibre api
     *
     * @var string
     */
    private $baseUrl = "https://api.mercadolibre.com";

    /**
     * We need this certificate for access the api
     *
     * @var string
     */
    private $libLocation = "/mercadopago/cert.pem";

    public function __construct()
    {
        $this->libLocation = storage_path($this->libLocation);
    }

    /**
     * Get requisition
     *
     * @param  string $uri
     * @param  string $content_type
     * @return string
     */
    public function get($uri, $content_type = "application/json")
    {
        return $this->exec("GET", $uri, null, $content_type);
    }

    /**
     * Post requisition
     *
     * @param  string $uri
     * @param  array $data
     * @param  string $content_type
     * @return string
     */
    public function post($uri, $data, $content_type = "application/json")
    {
        return $this->exec("POST", $uri, $data, $content_type);
    }

    /**
     * PUT requisition
     *
     * @param  string $uri
     * @param  array $data
     * @param  string $content_type
     * @return string
     */
    public function put($uri, $data, $content_type = "application/json")
    {
        return $this->exec("PUT", $uri, $data, $content_type);
    }

    /**
     * Create the connection
     *
     * @param  string $uri
     * @param  string $method
     * @param  string $content_type
     * @return string
     */
    private function get_connect($uri, $method, $content_type)
    {
        $connect = curl_init($this->baseUrl . $uri);

        curl_setopt($connect, CURLOPT_USERAGENT, "MercadoPago PHP SDK v" . $this->version);
        curl_setopt($connect, CURLOPT_CAINFO, $this->libLocation);
        curl_setopt($connect, CURLOPT_SSLVERSION, 3);
        curl_setopt($connect, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($connect, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($connect, CURLOPT_HTTPHEADER, array("Accept: application/json", "Content-Type: " . $content_type));

        return $connect;
    }

    /**
     * Set the data
     *
     * @param curl $connect
     * @param mixed $data
     * @param string $content_type
     */
    private function set_data(&$connect, $data, $content_type)
    {
        if ($content_type == "application/json")
        {
            if (gettype($data) == "string")
            {
                json_decode($data, true);
            }
            else
            {
                $data = json_encode($data);
            }

            if (function_exists('json_last_error'))
            {
                $json_error = json_last_error();

                if ($json_error != JSON_ERROR_NONE)
                {
                    throw new \Exception("JSON Error [{$json_error}] - Data: {$data}");
                }
            }
        }

        curl_setopt($connect, CURLOPT_POSTFIELDS, $data);
    }

    /**
     * Execute the curl requisition
     *
     * @param  string $method
     * @param  string $uri
     * @param  mixed $data
     * @param  string $content_type
     * @return string
     */
    private function exec($method, $uri, $data, $content_type)
    {
        $connect = $this->get_connect($uri, $method, $content_type);

        if ($data)
        {
            $this->set_data($connect, $data, $content_type);
        }

        $api_result = curl_exec($connect);
        $api_http_code = curl_getinfo($connect, CURLINFO_HTTP_CODE);

        $response = array(
            "status" => $api_http_code,
            "response" => json_decode($api_result, true)
        );

        if ($response['status'] >= 400)
        {
            throw new \Exception ($response['response']['message'], $response['status']);
        }

        curl_close($connect);

        return $response;
    }
}
