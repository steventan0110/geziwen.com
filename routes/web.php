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

Route::get('/', 'WelcomeController@welcome')->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('search')->group(function () {
    Route::get('/', 'SearchController@result')->name('search');
});

//Route::prefix('plan')->group(function () {
//    Route::get('{id}', 'PlanController@view')->name('agency.plan.show');
//});

Route::resource('agency.applicant', 'AgencyApplicantController');

Route::resource('plan.applicant', 'PlanApplicantController');

Route::resource('teacher.applicant', 'TeacherApplicantController');

Route::resource('agency.teacher','AgencyTeacherController');

Route::resource('agency', 'AgencyController');

Route::resource('agency.plan', 'AgencyPlanController');
