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

Auth::routes(['verify' => true]);

Route::any('/', 'HomeController@index')->name('home');
Route::any('/report', 'HomeController@report')->name('report');

Route::prefix('ajax')->group(function () {
    Route::prefix('log')->group(function () {
        Route::get('groupByIp/{startDate}/{endDate}', 'AjaxController@groupedByIpLog');
        Route::get('groupByIpDate/{startDate}/{endDate}', 'AjaxController@groupedByDateLog');
    });
});
