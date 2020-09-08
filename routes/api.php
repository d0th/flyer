<?php

use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
//news
Route::post('/all_news/{locale}', 'api\NewsController@index');
Route::post('/news/{locale}', 'api\NewsController@news');
Route::post('/stocks_news/{locale}', 'api\NewsController@stocks_news');

//media
Route::post('/all_media/{slug}/{locale}', 'api\MediaController@index');
Route::post('/foto/{slug}/{locale}', 'api\MediaController@mediaFoto');
Route::post('/video/{slug}/{locale}', 'api\MediaController@mediaVideo');

Route::group(['prefix' => '/v1', 'as' => 'api.', 'middleware' => []], function () {
    Route::post('/getAvailableBookableDaysMulti', 'Api\ApiController@getAvailableBookableDaysMulti');
    Route::get('/getFlying', 'Api\ApiController@getFlying');
    Route::post('/chooseDate', 'Api\ApiController@getChooseDate');
    Route::post('/chooseDay', 'Api\ApiController@getChooseDay');
    Route::post('/getChooseTime', 'Api\ApiController@getChooseTime');

    Route::post('/addCustomer', 'Api\ApiController@addCustomer');
    Route::get('/addOrder', 'Api\ApiController@addOrder');
    Route::post('/createOrder', 'frontend\OrderController@createOrder');
    Route::get('/payOrder', 'frontend\OrderController@payOrder');

    Route::get('/payment/notify', 'frontend\OrderController@notifyOrder');
    Route::post('/payment/notify', 'frontend\OrderController@notifyOrder');
});
