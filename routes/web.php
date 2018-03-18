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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('agency') -> group(function() {

    Route::prefix('teacher')->group(function() {
        Route::get('{id}', 'Agency\TeacherController@view');
    });

    Route::prefix('plan')->group(function () {
        Route::get('{id}', 'Agency\PlanController@view');
    });

    Route::get('{id}', 'Agency\AgencyController@view');

});