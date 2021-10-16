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
Route::get('/logout', 'UserController@logout');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index');
    Route::get('/home/{any}', 'HomeController@index');

    Route::group(['prefix' => 'home'], function () {
        Route::get('administrator/{any}', 'HomeController@index');
        Route::get('message/{any}', 'HomeController@index');
    });

});
