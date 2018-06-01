<?php

use Illuminate\Http\Request;

use App\Http\Resources\UniversityCollection;
use App\Http\Resources\ApplicationPlanCollection;
use App\Application\University;
use App\Application\Plan;

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
Route::post('comment','CommentController@store');
Route::post('comment/delete','CommentController@delete');
Route::post('comment/get','CommentController@get');
Route::post('sms/send','SmsController@send');
Route::post('sms/test','SmsController@test');
Route::post('mail/send','MailController@send');
Route::post('mail/test','MailController@test');

Route::get('university', function () {
    return new UniversityCollection(University::all());
});

Route::get('application/plan', function () {
    return new ApplicationPlanCollection(Plan::all());
});