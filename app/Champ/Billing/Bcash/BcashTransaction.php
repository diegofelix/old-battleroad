<?php namespace Champ\Billing\Bcash;

use Champ\Billing\Contracts\TransactionDataFormatter;
use Champ\Billing\Contracts\TransactionService;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class BcashTransaction implements TransactionService {

    /**
     * Service URL
     *
     * @var string
     */
    protected $serviceUrl = 'https://www.bcash.com.br/transacao/consulta';

    /**
     * Return type
     * 1 for XML
     * 2 for JSON
     *
     * @var integer
     */
    protected $returnType = 2;

    /**
     * Guzzle http client
     *
     * @var Client
     */
    protected $httpClient;

    /**
     * Transaction Data Formatter
     *
     * @var TransactionDataFormatter
     */
    protected $dataFormatter;

    public function __construct(Client $httpClient, TransactionDataFormatter $dataFormatter)
    {
        $this->httpClient = $httpClient;
        $this->dataFormatter = $dataFormatter;
    }

    /**
     * Get the details about a transaction by its id
     *
     * @param  int $id
     * @return array
     */
    public function getDetails($id)
    {
        $options['headers'] = $this->authenticationHeaders();
        $options['body'] = $this->getBody($id);

        try
        {
            $response = $this->httpClient->post($this->serviceUrl, $options);
            return $this->dataFormatter->format($response->json());
        }
        catch (ClientException $e)
        {
            return false;
        }
    }

    /**
     * Get the body of the request
     *
     * @param  int $id
     * @return array
     */
    private function getBody($id)
    {
        return [
            'id_pedido' => $id,
            'tipo_retorno' => $this->returnType
        ];
    }

    /**
     * Authenticate the request
     *
     * @return guzzle
     */
    private function authenticationHeaders()
    {
        $token = $this->getAuthenticationToken();

        return ['Authorization' => "Basic $token"];
    }

    /**
     * Generate a auth token
     *
     * @return string base64 string
     */
    private function getAuthenticationToken()
    {
        return base64_encode(getenv('BCASH_ACCOUNT') . ':' . getenv('BCASH_TOKEN'));
    }

}