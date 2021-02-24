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

Route::post('v1/payment', 'ApiOrderController@createPaymentLink');
Route::post('v1/status', 'ApiOrderController@getOrderStatusById');
Route::post('v1/order', 'ApiOrderController@getOrderById');
Route::post('v1/order/history', 'ApiOrderController@getOrderHistoryById');
Route::post('v1/webhook', 'ApiOrderController@createWebhook');
Route::post('v1/listner/orders', 'ApiOrderController@webhookOrderListener');
Route::post('v1/listner/subscriptions', 'ApiSubscriptionController@webhookSubscriptionListener');
Route::post('v1/plan/details', 'ApiSubscriptionController@getPlanDetailsById');
Route::post('v1/plans', 'ApiSubscriptionController@createPlan');
Route::get('v1/plans', 'ApiSubscriptionController@getAllPlans');
Route::post('v1/products', 'ApiSubscriptionController@createProduct');
Route::post('v1/subscriptions', 'ApiSubscriptionController@createSubscription');
Route::post('v1/subscription/details', 'ApiSubscriptionController@getSubscriptionDetailsById');
Route::post('v1/subscription/cancel', 'ApiSubscriptionController@cancelSubscriptionById');
Route::post('v1/subscription/activate', 'ApiSubscriptionController@activateSubscriptionById');
Route::post('v1/subscription/revise', 'ApiSubscriptionController@reviseSubscriptionById');
Route::post('v1/subscription/update', 'ApiSubscriptionController@updateSubscriptionById');
