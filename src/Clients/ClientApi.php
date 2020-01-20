<?php


namespace NetLinker\FastBaselinker\Clients;

use GuzzleHttp\Client;
use NetLinker\FastBaselinker\Exceptions\FastBaselinkerException;
use NetLinker\FastBaselinker\Validator\ConnectionValidator;


class ClientApi
{

    /** @var Client */
    protected $client;

    /** @var string $token */
    protected $token;

    /** @var ConnectionValidator $connectionValidator */
    protected $connectionValidator;

    /** @var ApiRequest $apiRequest */
    protected $apiRequest;

    /**
     * Constructor
     * @param string $token
     */
    public function __construct(string $token)
    {
        $this->client = ClientBuilder::create()->build();
        $this->apiRequest = new ApiRequest();
        $this->connectionValidator = new ConnectionValidator();
        $this->token = $token;
    }

    /**
     * Send request
     *
     * @param $method
     * @param array $parameters
     * @return mixed
     * @throws FastBaselinkerException
     */
    public function request($method, $parameters = []){

        $resJson = $this->apiRequest->send($this, $method, $parameters);

        if (isset($resJson['status']) && $resJson['status'] === 'ERROR') {

            $errorMessage = $resJson['error_message'];

            $error = ($errorMessage) ? $errorMessage : $resJson['error_code'];

            throw new FastBaselinkerException($error);
        }
        return $resJson;
    }

    /**
     * Valid connection
     *
     * @return bool
     */
    public function validConnection(){
        return !$this->connectionValidator->validate($this);
    }

    /**
     * Get client
     *
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Get token
     *
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * Get API request
     *
     * @return ApiRequest
     */
    public function getApiRequest(): ApiRequest
    {
        return $this->apiRequest;
    }


}