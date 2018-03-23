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
use App\Agency\Agency;
use App\Agency\Teacher;

class Applicant extends Model
{

    protected $table = "applicants";

    /**
     * Each applicant may have one TOEFL record.
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function toefl() {
        return $this->hasOne(Toefl::class);
    }

    /**
     * Each applicant may have one SAT record.
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function sat() {
        return $this->hasOne(Sat::class);
    }

    /**
     * Each applicant may have one IELTS record.
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ielts() {
        return $this->hasOne(Ielts::class);
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
}