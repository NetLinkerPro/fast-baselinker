<?php

namespace NetLinker\FastBaselinker\Tests;

use Dotenv\Dotenv;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class IntegratedTest extends TestCase
{

    use DatabaseTransactions;

    /**
     * Setup the test environment.
     */
    public function setUp(): void
    {
        parent::setUp();
    }


    public function test()
    {
        $this->assertTrue(true);
    }
}
