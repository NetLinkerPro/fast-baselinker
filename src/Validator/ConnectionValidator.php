<?php


namespace NetLinker\FastBaselinker\Validator;


use GuzzleHttp\RequestOptions;
use Illuminate\Support\Facades\Log;
use NetLinker\FastBaselinker\Clients\ApiRequest;
use NetLinker\FastBaselinker\Clients\ClientApi;
use NetLinker\FastBaselinker\Methods\MethodBaselinker;

class ConnectionValidator
{

    /**
     * Validate client API
     *
     * @param ClientApi $clientApi
     * @return array|mixed
     */
    public function validate(ClientApi $clientApi)
    {
        $resJson = $clientApi->getApiRequest()->send($clientApi, MethodBaselinker::GET_COURIERS_LIST);

        Log::debug('Baselinker connection validate response: ' . json_encode($resJson, JSON_UNESCAPED_UNICODE));

        if (isset($resJson['status']) && $resJson['status'] === 'ERROR') {
            return $resJson;
        }

        return [];
    }
}