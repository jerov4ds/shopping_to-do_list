<?php

use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\ItemsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => ['cors', 'json.response']], function () {
    Route::post('lists', [CategoriesController::class, 'store']);
    Route::get('lists', [CategoriesController::class, 'index']);
    Route::get('lists/{id}', [CategoriesController::class, 'show']);
    Route::patch('lists/{id}', [CategoriesController::class, 'update']);
    Route::delete('lists/{id}', [CategoriesController::class, 'destroy']);
    Route::post('items', [ItemsController::class, 'store']);
    Route::put('items/{id}', [ItemsController::class, 'store']);
    Route::get('items', [ItemsController::class, 'index']);
    Route::get('items/{id}', [ItemsController::class, 'show']);
    Route::patch('items/{id}', [ItemsController::class, 'mark_as_complete']);
    Route::delete('items/{id}', [ItemsController::class, 'destroy']);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
