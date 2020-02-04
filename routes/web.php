<?php


use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::domain(config('fast-baselinker.domain'))
    ->as('fast-baselinker.')
    ->prefix(config('fast-baselinker.prefix'))
    ->middleware(config('fast-baselinker.middleware'))
    ->group(function () {

        # Assets AWES
        Route::get('assets/{module}/{type}/{filename}', config('fast-baselinker.controllers.assets') . '@getAwes')->name('assets.awes');

        # Dashboard
        Route::prefix('/')->as('dashboard.')->group(function () {
            Route::get('/', config('fast-baselinker.controllers.dashboard') . '@index')->name('index');
        });

        # Accounts
        Route::prefix('accounts')->as('accounts.')->group(function () {
            Route::get('/', config('fast-baselinker.controllers.accounts') . '@index')->name('index');
            Route::get('scope', config('fast-baselinker.controllers.accounts') . '@scope')->name('scope');
            Route::post('store', config('fast-baselinker.controllers.accounts') . '@store')->name('store');
            Route::patch('{id?}', config('fast-baselinker.controllers.accounts') . '@update')->name('update');
            Route::delete('{id?}', config('fast-baselinker.controllers.accounts') . '@destroy')->name('destroy');
        });
});




