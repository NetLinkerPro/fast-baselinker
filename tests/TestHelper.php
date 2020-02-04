<?php

namespace NetLinker\FastBaselinker\Tests;

use Carbon\Carbon;
use Dotenv\Dotenv;
use Facebook\WebDriver\WebDriverPoint;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Laravel\Dusk\Browser;
use NetLinker\FastBaselinker\Tests\Stubs\User;
use Symfony\Component\Process\Process;

trait TestHelper
{
    protected function seeInConsoleOutput($expectedText)
    {
        $consoleOutput = $this->app[Kernel::class]->output();
        $this->assertStringContainsString($expectedText, $consoleOutput,
            "Did not see `{$expectedText}` in console output: `$consoleOutput`");
    }

    protected function doNotSeeInConsoleOutput($unExpectedText)
    {
        $consoleOutput = $this->app[Kernel::class]->output();
        $this->assertStringNotContainsString($unExpectedText, $consoleOutput,
            "Did not expect to see `{$unExpectedText}` in console output: `$consoleOutput`");
    }

    /**
     * Create a modified copy of testbench to be used as a template.
     * Before each test, a fresh copy of the template is created.
     */
    private static function setUpLocalTestbench()
    {
        fwrite(STDOUT, "Setting up test environment for first use.\n");
        $files = new Filesystem();
        $files->makeDirectory(self::TEST_APP_TEMPLATE, 0755, true);
        $original = __DIR__ . '/../vendor/orchestra/testbench-core/laravel/';
        $files->copyDirectory($original, self::TEST_APP_TEMPLATE);
        // Modify the composer.json file
        $composer = json_decode($files->get(self::TEST_APP_TEMPLATE . '/composer.json'), true);
        // Remove "tests/TestCase.php" from autoload (it doesn't exist)
        unset($composer['autoload']['classmap'][1]);
        // Pre-install illuminate/support
        $composer['require'] = [
            'awes-io/base-js' => '^1.8',
            'awes-io/indigo-layout' => '^1.10',
            'awes-io/localization-helper' => '^1.0',
            'awes-io/repository' => '^1.0',
            'illuminate/support' => '~5',
        ];
        // Install stable version
        $composer['minimum-stability'] = 'stable';

        // Add API Key for AWES packages
        $composer['repositories'] = [
            0 => [
                'type' => 'composer',
                'url' => 'https://repo.pkgkit.com',
                'options' => [
                    'http' => [
                        'header' => [
                            'API-TOKEN: dd6553e92dcf6b171c35924a6dc63daaec412f44e2cab6f42e00ebb14fc4ce96'
                        ]
                    ]
                ]
            ]
        ];

        $files->put(self::TEST_APP_TEMPLATE . '/composer.json', json_encode($composer, JSON_PRETTY_PRINT));
        // Install dependencies
        fwrite(STDOUT, "Installing test environment dependencies\n");
        (new Process(['composer', 'install', '--no-dev'], self::TEST_APP_TEMPLATE))->setTimeout(200)->run(function ($type, $buffer) {
            fwrite(STDOUT, $buffer);
        });

    }

    public static function browserWatch(Browser $browser)
    {
        $files = new \Illuminate\Filesystem\Filesystem;
        $tracker = new \JasonLewis\ResourceWatcher\Tracker;
        $watcher = new \JasonLewis\ResourceWatcher\Watcher($tracker, $files);

        $watchDir = realpath(__DIR__ . '/../');
        $listener = $watcher->watch($watchDir);

        $refreshing = false;

        $listener->onModify(function($resource, $path) use (&$browser, &$refreshing, &$watchDir) {

            // exclude paths
            $excludePath = !!array_filter(['testbench', '.idea', 'tests'], function($dir) use (&$path, &$watchDir){
                return Str::startsWith($path, $watchDir . '/' . $dir);
            });

            if ($refreshing || $excludePath) {
                return;
            }

            dump("{$path} has been modified.".PHP_EOL);

            $refreshing = true;
            $browser->refresh();
            $refreshing = false;
        });

        dump('browser watching...');

        $watcher->start();
    }

    /**
     * Maximize browser to screen
     *
     * @param Browser $browser
     * @param int $x
     * @param int $y
     */
    public static function maximizeBrowserToScreen(Browser $browser, int $x = 0, int $y = 0)
    {
        $browser->driver->manage()->window()->setPosition(new WebDriverPoint($x, $y));
        $browser->driver->manage()->window()->maximize();
    }

    public static function getEnvironmentSetUp($app)
    {

        // Set auth eloquent
        $app['config']->set('auth.providers.users.model', User::class);

        // Set application locale
        $app['config']->set('app.locale', 'pl');

        // Set key application for crypt
        $_ENV['APP_KEY'] = 'base64:48of4vqfrTmN8zMSsfVnwN9y2GLovwpbIjiRUUFGL18=';
        $app['config']->set('app.key', $_ENV['APP_KEY']);

        // Enable debug mode for application
        $app['config']->set('app.debug', true);

        // Set app url in config
        $_ENV['APP_URL'] = 'http://localhost:8000';
        $app['config']->set('app.url', $_ENV['APP_URL']);

        // Load env variables from phpunit command or file .env
        $awesKey = env('PKGKIT_CDN_KEY');

        $fileEnv = Dotenv::create(__DIR__ . '/../')->load();
        $_ENV['PKGKIT_CDN_KEY'] = $awesKey ? $awesKey : $fileEnv['PKGKIT_CDN_KEY'];


        // Set token API to Baselinker
        $apiToken = env('TOKEN_API') ? env('TOKEN_API') : $fileEnv['TOKEN_API'];
        $app['config']->set('fast-baselinker-test.token_api', $apiToken);


        // Set browser with UI for tests
        $_ENV['BROWSER_WITH_UI'] = $fileEnv['BROWSER_WITH_UI'] ?? false;
        if (env('BROWSER_WITH_UI')) {
            \Orchestra\Testbench\Dusk\Options::withUI();
        } else {
            \Orchestra\Testbench\Dusk\Options::withoutUI();
        }

        // Set API key for AWES
        $app['config']->set('indigo-layout.frontend.key', $_ENV['PKGKIT_CDN_KEY']);
        $app['config']->set('base-js.placeholders.{key}', $_ENV['PKGKIT_CDN_KEY']);

        // Set display logs to console
        $app['config']->set('logging.default', 'stderr');

        // Setup default database to use sqlite :memory:
        $databasePath = __DIR__ . '/database/database.sqlite';
        if (!File::exists($databasePath)){
            File::put($databasePath, '');
        }

        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver' => 'sqlite',
            'database' => $databasePath,
            'prefix' => '',
        ]);


        Carbon::setLocale(config('app.locale'));
    }

    public static function getPackageProviders($app)
    {
        return [
            'NetLinker\FastBaselinker\FastBaselinkerServiceProvider',
            'AwesIO\BaseJS\BaseJSServiceProvider',
            'AwesIO\IndigoLayout\IndigoLayoutServiceProvider',
            'AwesIO\LocalizationHelper\LocalizationHelperServiceProvider',
            'AwesIO\ThemeSwitcher\ThemeSwitcherServiceProvider',
            'AwesIO\SystemNotify\SystemNotifyServiceProvider',
            'AwesIO\Repository\RepositoryServiceProvider',
        ];
    }

    public static function getPackageAliases($app)
    {
        return [
            'LocalizationHelper' => ' AwesIO\LocalizationHelper\Facades\LocalizationHelper',
            'Notify' => 'AwesIO\\SystemNotify\\Facades\\Notify',
        ];
    }

    protected function installTestApp()
    {
        $this->uninstallTestApp();
        $files = new Filesystem();
        $files->copyDirectory(self::TEST_APP_TEMPLATE, self::TEST_APP);

    }

    protected function uninstallTestApp()
    {
        $files = new Filesystem();
        if ($files->exists(self::TEST_APP)) {
            $files->deleteDirectory(self::TEST_APP);
        }
    }
}
