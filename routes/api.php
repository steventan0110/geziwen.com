<?php

use Illuminate\Http\Request;

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
Route::post('teacher/comment','CommentController@storeTeacherComment');
Route::post('teacher/comment/delete','CommentController@deleteTeacherComment');
Route::post('teacher/comment/get','CommentController@getTeacherComment');
Route::post('agency/comment','CommentController@storeAgencyComment');
Route::post('agency/comment/delete','CommentController@deleteAgencyComment');
Route::post('agency/comment/get','CommentController@getAgencyComment');
