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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('book','RestController@createBooking')->middleware('cors');

Route::post('checkbook','RestController@checkBooking')->middleware('cors');

Route::post('check','RestController@checkBooked')->middleware('cors');

Route::post('rate','RestController@rateme')->middleware('cors');

Route::post('pay','RestController@payme')->middleware('cors');

Route::post('login','RestController@login')->middleware('cors');

Route::post('chet','RestController@checkpass')->middleware('cors');

Route::post('enb','RestController@enabler')->middleware('cors');

Route::post('play','RestController@playme')->middleware('cors');

Route::post('del','RestController@deactivate')->middleware('cors');

Route::post('paid','RestController@ispaid')->middleware('cors');

Route::post('cancelled','RestController@cancelled')->middleware('cors');

Route::post('error','RestController@goterror')->middleware('cors');
