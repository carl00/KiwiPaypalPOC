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
Route::post('v1/order/history', 'ApiController@getOrderHistoryById');
Route::post('v1/webhook', 'ApiController@createWebhook');
Route::post('v1/listner/orders', 'ApiController@webhookOrderListener');
Route::post('v1/listner/subscriptions', 'ApiController@webhookSubscriptionListener');
Route::post('v1/plan/details', 'ApiController@getPlanDetailsById');
Route::post('v1/plans', 'ApiController@createPlan');
Route::get('v1/plans', 'ApiController@getAllPlans');
Route::post('v1/products', 'ApiController@createProduct');
Route::post('v1/subscriptions', 'ApiController@createSubscription');
Route::post('v1/subscription/details', 'ApiController@getSubscriptionDetailsById');
Route::post('v1/subscription/cancel', 'ApiController@cancelSubscriptionById');
Route::post('v1/subscription/activate', 'ApiController@activateSubscriptionById');
Route::post('v1/subscription/revise', 'ApiController@reviseSubscriptionById');
Route::post('v1/subscription/update', 'ApiController@updateSubscriptionById');
