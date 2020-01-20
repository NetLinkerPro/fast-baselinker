<?php


namespace NetLinker\FastBaselinker\Clients;


class ApiRequest
{

    /**
     * Send request
     *
     * @param ClientApi $clientApi
     * @param string $method
     * @param array $parameters
     * @return mixed
     */
    public function send(ClientApi $clientApi, string $method, array $parameters = []){

        $client = $clientApi->getClient();

        $res = $client->post(config('fast-baselinker.api.address'), [
            'form_params'=> [
                'token' => $clientApi->getToken(),
                'method' => $method,
                'parameters' => json_encode($parameters, JSON_UNESCAPED_UNICODE),
            ]
        ]);

        return json_decode($res->getBody()->getContents(), JSON_UNESCAPED_UNICODE);
    }

}