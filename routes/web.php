<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/logout', 'UsersController@logout');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index');
    Route::get('/home/calendar', 'HomeController@getCalendarEvent');
    Route::get('/home/user-list', 'HomeController@getUserList');
    Route::get('/home/future-event-list', 'HomeController@getFutureEventList');
    Route::post('/home/add-calendar-event', 'HomeController@addCalendarEvent');
    Route::delete('/home/delete-calendar-event/{eventId}', 'HomeController@deleteCalendarEvent');

    Route::group(['prefix' => 'home'], function () {
        Route::get('administrator/{any}', 'HomeController@index');
        Route::get('message/{any}', 'HomeController@index');
    });

});

Route::get('/test-data', 'TestController@Test');
Route::get('/test-data2', 'HomeController@getUserList');

