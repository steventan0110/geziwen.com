<?php

use Illuminate\Http\Request;

use App\Application\University;
use App\Application\Plan;
use App\Agency\Agency;
use App\Agency\Teacher;
use App\Applicant\Applicant;
use App\Http\Resources\ApplicationPlanCollection;
use App\Http\Resources\UniversityCollection;
use App\Http\Resources\ApplicantResource;
use App\Http\Resources\TeacherResource;
use App\Http\Resources\AgencyResource;
use App\Http\Resources\ExamResource;
use App\Http\Resources\ActivityResource;
use App\Http\Resources\OfferResource;
use App\Http\Resources\AwardResource;

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

Route::get('agencies', function() {
    return AgencyResource::collection(Agency::paginate(5));
});

Route::get('agencies/{agency_id}', function($agency_id) {
    return new AgencyResource(Agency::find($agency_id));
});

Route::get('teacher/{teacher_id}', function($teacher_id) {
    return new TeacherResource(Teacher::find($teacher_id));
});

Route::get('agency/{agency_id}/teachers', function($agency_id) {
    return TeacherResource::collection(Agency::find($agency_id)->teachers()->paginate(5));
});

Route::prefix('applicant/{applicant}')->group(function () {

    Route::get('/', function ($applicant) {
        return new ApplicantResource(Applicant::find($applicant));
    });

    Route::get('exams', function ($applicant) {
        return ExamResource::collection(Applicant::find($applicant)->exams()->get());
    });

    Route::get('activities', function ($applicant) {
        return ActivityResource::collection(Applicant::find($applicant)->activities()->get());
    });

    Route::get('awards', function ($applicant) {
        return AwardResource::collection(Applicant::find($applicant)->awards()->get());
    });

    Route::get('offers', function ($applicant) {
        return OfferResource::collection(Applicant::find($applicant)->offers()->get());
    });
});

Route::get('agency/{agency_id}/applicants', function($agency_id) {
    return ApplicantResource::collection(Agency::find($agency_id)->applicants()->paginate(5));
});

