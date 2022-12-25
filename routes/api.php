<?php

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
    Route::post('lists', 'Api\CategoriesController@store');
    Route::get('lists', 'Api\CategoriesController@index');
    Route::get('lists/{id}', 'Api\CategoriesController@show');
    Route::patch('lists/{id}', 'Api\CategoriesController@update');
    Route::delete('lists/{id}', 'Api\CategoriesController@reset');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
