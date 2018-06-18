<?php

namespace App\Applicant;

use App\Agency\Service\Plan;
use App\Applicant\Exam\Act;
use App\Applicant\Exam\Ap;
use App\Applicant\Exam\Ielts;
use App\Applicant\Exam\Sat;
use App\Applicant\Exam\SatSubject;
use App\Applicant\Exam\Toefl;
use App\Application\Offer;
use Illuminate\Database\Eloquent\Model;
use App\Agency\Teacher;
use App\Agency\Agency;
use Laravel\Scout\Searchable;

class Applicant extends Model
{
    use Searchable;

    protected $table = "applicants";

    protected $hidden = ['created_at', 'updated_at', 'id', 'plan_id', 'pivot'];

    protected $fillable = ['surname', 'introduction'];

    public function searchableAs() {
        return config('scout.prefix') . 'applicants';
    }

    public function toSearchableArray() {
        $applicant = $this->toArray();
        $applicant['agency'] = $this->plan->agency;
        $applicant['type'] = $this->plan->agency->type;
        $applicant['exams'] = $this->exams;
        $applicant['activities'] = $this->activities->map(function ($activity) {
            return [
                'name' => $activity->name,
                'type' => $activity->type->name
            ];
        });
        $applicant['awards'] = $this->awards->map(function ($award) {
            return [
                'name' => $award->name,
            ];
        });
        $applicant['offers'] = $this->offers->map(function ($offer) {
            return [
                'university' => $offer->university->name,
                'plan' => $offer->plan->name,
                'plan_shorthand' => $offer->plan->shorthand
            ];
        });
        unset($applicant['created_at'], $applicant['updated_at'], $applicant['plan_id']);
        return $applicant;
    }

    public function exams() {
        return $this->hasMany(Exam::class);
    }

    public function activities() {
        return $this->hasMany(Activity::class);
    }

    public function awards() {
        return $this->hasMany(Award::class);
    }

    public function agency() {
        return $this->belongsTo(Agency::class);
    }

    public function offers() {
        return $this->hasMany(Offer::class);
    }

    public function plan() {
        return $this->belongsTo(Plan::class);
    }

    public function teachers() {
        return $this->belongsToMany(Teacher::class,'teachers_applicants','teacher_id','applicant_id');
    }

}