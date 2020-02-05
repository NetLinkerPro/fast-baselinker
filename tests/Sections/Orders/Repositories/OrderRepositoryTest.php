<?php

namespace NetLinker\FastBaselinker\Tests\Sections\Orders\Repositories;


use Carbon\Carbon;
use NetLinker\FastBaselinker\Clients\ClientApi;
use NetLinker\FastBaselinker\Methods\MethodBaselinker;
use NetLinker\FastBaselinker\Sections\Orders\Repositories\OrderRepository;
use NetLinker\FastBaselinker\Tests\TestCase;

class OrderRepositoryTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();
    }

    public function testGetAllOrdersMoreFrom100(){
        $client = new ClientApi(config('fast-baselinker-test.token_api'));
        $orders = new OrderRepository();
        $list = $orders->get($client, Carbon::now()->subMonth());
        $this->assertTrue(sizeof($list)>10);
    }


}
