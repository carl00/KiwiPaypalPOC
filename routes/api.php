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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('v1/payment', 'ApiController@createPaymentLink');
Route::post('v1/status', 'ApiController@getOrderStatusById');
Route::post('v1/order', 'ApiController@getOrderById');
Route::post('v1/webhook', 'ApiController@createWebhook');

    