<?php

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

//Route::get('/', function () {
  //  return view('welcome');
//});
Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/rooms', 'HomeController@rooms')->name('rooms');

Route::get('/rooms/type/{type}','HomeController@roomtypes')->name('room_type');

Route::get('/rooms/room/{rid}','HomeController@roomdetails')->name('room_details');

Route::get('/rooms/create','HomeController@createroom')->middleware('auth');

Route::resource('/admin','AdminController')->middleware('auth');

Route::get('/history','HomeController@history')->middleware('auth');

Route::get('search/{qid}/{rid}/{lid}', 'HomeController@searchthree');

Route::get('search/{qid}', 'HomeController@searchone');

Route::get('/location/{lid}','HomeController@locations');

Route::get('/slider/{sid}','HomeController@slider');

Route::get('mail','HomeController@mail');

Route::get('invoice/{id}/{no}','HomeController@invoice');

Route::get('loginas/{id}/{pid}/{tid}', "HomeController@fakeLogin")->name('loginAs');
