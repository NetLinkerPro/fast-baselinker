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

    protected function getEnvironmentSetUp($app)
    {
        $env = Dotenv::create(__DIR__ . '/../../')->load();
        $envToken = env('TOKEN_API');
        $apiToken = $envToken ? $envToken : $env['TOKEN_API'];
        Config::set('fast-baselinker-test.token_api', $apiToken);
        Config::set('logging.default', 'stderr');
    }

    public function testSendRequestWithParameters(){
        $client = new ClientApi(config('fast-baselinker-test.token_api'));
        $jsonResp = $client->request(MethodBaselinker::GET_COURIER_FIELDS, ['courier_code' => 'allekurier']);
        $this->assertIsArray($jsonResp);
    }


}
