<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EnvironmentController;
use App\Http\Controllers\IconController;
use App\Http\Controllers\SiteController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */

Route::get('/', [HomeController::class, 'index']);

Route::group(['prefix' => 'auth'], function ($router) {
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth:sanctum')->group(function ($router) {
    Route::group(['prefix' => 'auth'], function ($router) {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/refresh', [AuthController::class, 'refresh']);
        Route::get('/user', [AuthController::class, 'userProfile']);
    });

    Route::group(['prefix' => 'environments'], function ($router) {
        Route::get('/', [EnvironmentController::class, 'getAll']);
        Route::get('/{id}', [EnvironmentController::class, 'get']);
        Route::get('/{id}/sites', [EnvironmentController::class, 'getSites']);
        Route::post('/', [EnvironmentController::class, 'add']);
        Route::put('/{id}', [EnvironmentController::class, 'edit']);
        Route::delete('/{id}', [EnvironmentController::class, 'delete']);
    });

    Route::group(['prefix' => 'icons'], function ($router) {
        Route::get('/', [IconController::class, 'getAll']);
        Route::get('/{id}', [IconController::class, 'get']);
    });

    Route::group(['prefix' => 'sites'], function ($router) {
        Route::get('/', [SiteController::class, 'getAll']);
        Route::get('/{id}', [SiteController::class, 'get']);
        Route::post('/', [SiteController::class, 'add']);
        Route::put('/{id}', [SiteController::class, 'edit']);
        Route::delete('/{id}', [SiteController::class, 'delete']);
    });
});
