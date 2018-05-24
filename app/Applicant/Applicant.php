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

    public function searchableAs() {
        return $this->table."_index";
    }

    public function toSearchableArray() {
        $applicant = $this->toArray();
        $applicant['agency'] = [
            'name' => $this->plan->agency->name,
            'introduction' => $this->plan->agency->introduction
        ];
        $applicant['activities'] = $this->activity->map(function ($activity) {
            return [
                'name' => $activity->name,
                'introduction' => $activity->introduction
            ];
        });
        $applicant['awards'] = $this->award->map(function ($award) {
            return [
                'name' => $award->name,
                'introduction' => $award->introduction
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

    /**
     * Each applicant may have multiple TOEFL record.
     * (Changed from one to multiple due to the language trainer feature)
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function toefl() {
        return $this->hasMany(Toefl::class);
    }

    /**
     * Each applicant may have one SAT record.
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function sat() {
        return $this->hasOne(Sat::class);
    }

    /**
     * Each applicant may have multiple IELTS record.
     * (Changed from one to multiple due to the language trainer feature)
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ielts() {
        return $this->hasMany(Ielts::class);
    }

    /**
     * Each applicant may have one or more SAT Subject test records.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function satSubjects() {
        return $this->hasMany(SatSubject::class);
    }

    /**
     * Each applicant may have one or more AP test records.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function aps() {
        return $this->hasMany(Ap::class);
    }

    /**
     * Each applicant may have one ACT test record.
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function act() {
        return $this->hasOne(Act::class);
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

//    public function exam_type() {
//        return $this->table.'exam_type_id';
//    }
}