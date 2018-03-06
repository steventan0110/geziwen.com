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

Route::prefix('applicant') -> group(function() {

    Route::get('edit/{id}', 'ApplicantController@edit');

    Route::get('create/{id}', 'ApplicantController@create');

    Route::get('view/{id}', 'ApplicantController@view');

    Route::get('delete/{id}', 'ApplicantController@delete');
});

Route::prefix('agency') -> group(function() {

    Route::get('view/{id}', 'AgencyController@view');

    Route::get('create/{id}', 'AgencyController@create');

    Route::get('edit/{id}', 'AgencyController@edit');

    Route::get('delete/{id}', 'AgencyController@delete');

});