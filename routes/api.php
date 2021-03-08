<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Passport;

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


Route::group(['prefix' => 'representative-panel'], function () {

    Route::post('/login', 'UserController@login');

    Route::group(['middleware' => ['auth:api']], function() {
        Route::get('/orders', 'OrdersController@orders');
        Route::get('/order/{id}', 'OrdersController@order');
        Route::post('/orders/change-status-to-three', 'OrdersController@updateStatusToThree');
        Route::post('/orders/change-status-to-four', 'OrdersController@updateStatusAndVerify');
        Route::post('/orders/update-status-to-complete', 'OrdersController@updateStatusToComplete');
        Route::get('/profile','UserController@profile');
        Route::get('/representative-commission','UserController@representativeCommission');
    });
});
