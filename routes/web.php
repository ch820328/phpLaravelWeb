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
    Route::group(['prefix' => 'home'], function () {
        Route::get('/calendar/get', 'HomeController@getCalendarEvent');
        Route::get('/user-list/get', 'HomeController@getUserList');
        Route::get('/future-event-list/get', 'HomeController@getFutureEventList');
        Route::post('/add-calendar-event/post', 'HomeController@addCalendarEvent');
        Route::delete('/delete-calendar-event/delete/{eventId}', 'HomeController@deleteCalendarEvent');
    });

    Route::group(['prefix' => 'information'], function () {
        Route::get('/family/get', 'InformationController@getFamilyList');
        Route::get('/program/get', 'InformationController@getProgramList');
        Route::post('/update-information-list/post', 'InformationController@updateInformationList');
        Route::delete('/delete-information-list/delete/{informationId}', 'InformationController@deleteInformation');
    });


});

Route::get('/test-data', 'TestController@Test');
Route::get('/test-data2', 'TestController@Test2');

Route::get('/{any1}', 'HomeController@index');
Route::get('/{any1}/{any2}', 'HomeController@index');
