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
    ->name('fast-baselinker.')
    ->prefix(config('fast-baselinker.prefix'))
    ->middleware(config('fast-baselinker.middleware'))
    ->group(function () {

        # Vendor assets
        Route::prefix('assets')->as('assets.')->group(function () {

            // CSS
            Route::prefix('css')->as('css.')->group(function () {
                Route::get('indigo-layout.css', config('fast-baselinker.controllers.assets') . '@cssIndigoLayout')->name('indigo_layout');
                Route::get('system-notify.css', config('fast-baselinker.controllers.assets') . '@cssSystemNotify')->name('system_notify');
                Route::get('table-builder.css', config('fast-baselinker.controllers.assets') . '@cssTableBuilder')->name('table_builder');
                Route::get('context-menu.css', config('fast-baselinker.controllers.assets') . '@cssContextMenu')->name('context_menu');
                Route::get('modal-window.css', config('fast-baselinker.controllers.assets') . '@cssModalWindow')->name('modal_window');
                Route::get('form-builder.css', config('fast-baselinker.controllers.assets') . '@cssFormBuilder')->name('form_builder');
            });

            // JS
            Route::prefix('js')->as('js.')->group(function () {
                Route::get('indigo-layout.js', config('fast-baselinker.controllers.assets') . '@jsIndigoLayout')->name('indigo_layout');
                Route::get('system-notify.js', config('fast-baselinker.controllers.assets') . '@jsSystemNotify')->name('system_notify');
                Route::get('theme-switcher.js', config('fast-baselinker.controllers.assets') . '@jsThemeSwitcher')->name('theme_switcher');
                Route::get('base-js.js', config('fast-baselinker.controllers.assets') . '@jsBaseJs')->name('base_js');
                Route::get('table-builder.js', config('fast-baselinker.controllers.assets') . '@jsTableBuilder')->name('table_builder');
                Route::get('context-menu.js', config('fast-baselinker.controllers.assets') . '@jsContextMenu')->name('context_menu');
                Route::get('modal-window.js', config('fast-baselinker.controllers.assets') . '@jsModalWindow')->name('modal_window');
                Route::get('form-builder.js', config('fast-baselinker.controllers.assets') . '@jsFormBuilder')->name('form_builder');
            });

            // Fonts
            Route::prefix('fonts')->as('fonts.')->group(function () {
                Route::get('icons.woff', config('fast-baselinker.controllers.assets') . '@fontsIconsWoff')->name('icons_woff');
                Route::get('icons.ttf', config('fast-baselinker.controllers.assets') . '@fontsIconsTtf')->name('icons_ttf');
                Route::get('icons.eot', config('fast-baselinker.controllers.assets') . '@fontsIconsEot')->name('icons_eot');
            });

            // Img
            Route::prefix('img')->as('img.')->group(function () {
                Route::get('loading.svg', config('fast-baselinker.controllers.assets') . '@imgLoadingSvg')->name('loading_svg');
            });
        });

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




