<?php

use App\Http\Controllers\DemoController;
use App\Http\Controllers\DemoLayoutController;
use App\Http\Controllers\TestController;
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

Route::get('/theme/{theme}/{group}/{component}', [\App\Http\Controllers\DocumentationController::class, 'component'])
    ->name('component');

Route::get('/test', [TestController::class, 'index']);
Route::post('/test', [TestController::class, 'change']);

Route::get('/demo', [DemoController::class, 'show']);

Route::prefix('/demo/layout/')->group(function() {
    Route::get('splash', [DemoLayoutController::class, 'splash']);
});
