<?php

namespace NetLinker\FastBaselinker\Tests;

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

    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

    }

    public function test()
    {
        $this->assertTrue(true);
    }
}
