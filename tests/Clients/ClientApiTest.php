<?php

namespace NetLinker\FastBaselinker\Tests\Clients;

use Dotenv\Dotenv;
use Illuminate\Support\Facades\Config;
use NetLinker\FastBaselinker\Clients\ClientApi;
use NetLinker\FastBaselinker\Methods\MethodBaselinker;
use NetLinker\FastBaselinker\Tests\TestCase;

class ClientApiTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();
    }

    public function testSendRequestWithParameters(){
        $client = new ClientApi(config('fast-baselinker-test.token_api'));
        $jsonResp = $client->request(MethodBaselinker::GET_COURIER_FIELDS, ['courier_code' => 'allekurier']);
        $jsonResp = $client->request(MethodBaselinker::GET_ORDERS, ['order_id' => '133412378']);
        $this->assertIsArray($jsonResp);
    }


}
