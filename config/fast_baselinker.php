<?php

return [

    /*
    |--------------------------------------------------------------------------
    | API
    |--------------------------------------------------------------------------
    |
    | Settings for Baselinker API
    |
    */

    'api' => [

        'address' => 'https://api.baselinker.com/connector.php',

        'verify_ssl' => false,

    ],


    /*
    |--------------------------------------------------------------------------
    | Owner
    |--------------------------------------------------------------------------
    |
    | Owner class for automation add owner to model.
    |
    */

    'owner' => [
        'model' => 'NetLinker\FastBaselinker\Tests\Stubs\Owner',
        'field_auth_user_owner_uuid' => 'owner_uuid'
    ],


    /*
   |--------------------------------------------------------------------------
   | Domain
   |--------------------------------------------------------------------------
   |
   | Route domain for module FastBaselinker. If null, domain will be
   | taken from `app.url` config.
   |
   */

    'domain' => null,

    /*
    |--------------------------------------------------------------------------
    | Prefix
    |--------------------------------------------------------------------------
    |
    | Route prefix for module FastBaselinker.
    |
    */

    'prefix' => 'fast-baselinker',


    /*
    |--------------------------------------------------------------------------
    | Web middleware
    |--------------------------------------------------------------------------
    |
    | Middleware for routes module FastBaselinker. Value is array.
    |
    */

    'middleware' => ['web'],

    /*
    |--------------------------------------------------------------------------
    | Controllers
    |--------------------------------------------------------------------------
    |
    | Namespaces for controllers.
    |
    */

    'controllers' => [

        'assets' => 'NetLinker\FastBaselinker\Sections\Assets\Controllers\AssetController',

        'dashboard' => 'NetLinker\FastBaselinker\Sections\Dashboard\Controllers\DashboardController',

        'accounts' => 'NetLinker\FastBaselinker\Sections\Accounts\Controllers\AccountController',

    ],
];