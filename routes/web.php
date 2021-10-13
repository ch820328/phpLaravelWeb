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

Route::get('/home', 'HomeController@index');

Route::group(['middleware' => ['auth']], function () {

//    Route::get('/home', 'HomeController@index');

//    Route::group(['prefix' => 'test-item', 'middleware' => 'role:administrator|biosToolDeveloper'], function () {
//        Route::get('create', 'TestItemController@showCreate');
//        Route::post('create', 'TestItemController@create');
//        Route::get('update/{id}', 'TestItemController@showUpdate');
//        Route::post('update/{id}', 'TestItemController@update');
//        Route::delete('delete/{id}', 'TestItemController@delete');
//        Route::group(['prefix' => '{testItemId}/condition'], function () {
//            Route::get('list', 'TestItemConditionController@list');
//        });
//    });
});
