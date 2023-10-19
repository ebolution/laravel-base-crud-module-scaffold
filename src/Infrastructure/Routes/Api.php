<?php
/**
 * @category  Ebolution
 * @package   Ebolution/BaseCrudModuleScaffold
 * @author    @module.author.name @module.author.email
 * @copyright @module.copyright
 * @license   @module.license
 */

namespace Ebolution\BaseCrudModuleScaffold\Infrastructure\Routes;

use Ebolution\BaseCrudModuleScaffold\Infrastructure\Controllers\Http\Api;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'V1'], function () {
    Route::group(['prefix' => '@table_name'], function () {
        Route::get('', [Api\FindAll::class, '__invoke']);
        Route::get('{id}', [Api\Find::class, '__invoke']);
        Route::post('', [Api\Save::class, '__invoke']);
        Route::put('{id}', [Api\Update::class, '__invoke']);
        Route::delete('{id}', [Api\Delete::class, '__invoke']);
    });
});
