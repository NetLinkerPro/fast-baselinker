<?php

namespace NetLinker\FastBaselinker\Tests;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Laravel\Dusk\Browser;
use NetLinker\FastBaselinker\Sections\Accounts\Models\Account;
use NetLinker\FastBaselinker\Tests\Stubs\Owner;
use NetLinker\FastBaselinker\Tests\Stubs\User;

class WatchBrowser extends BrowserTestCase
{


    /**
     * Setup the test environment.
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->withFactories(__DIR__ . '/database/factories');
        $this->loadLaravelMigrations();

    }

    /**
     * Refresh the application instance.
     *
     * @return void
     */
    protected function refreshApplication()
    {
        parent::refreshApplication();

        if (Schema::hasTable('users_test')) {
            Auth::login(User::all()->last());
        }

    }


    /**
     * @test
     *
     * @throws \Throwable
     */
    public function watch()
    {

        $owner = factory(Owner::class)->create();
        factory(User::class)->create(['owner_uuid' => $owner->uuid,]);
        Auth::login(User::all()->last());
        factory(Account::class)->create();

        $this->browse(function (Browser $browser) {

            TestHelper::maximizeBrowserToScreen($browser);
            $browser->visit('fast-baselinker/accounts');
            TestHelper::browserWatch($browser);
        });

        $this->assertTrue(true);
    }
}
