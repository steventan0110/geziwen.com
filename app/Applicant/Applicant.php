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
use App\Teacher\Teacher;

class Applicant extends Model
{

    protected $table = "applicants";

    /**
     * Each applicant may have one or more TOEFL test records.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function toefls() {
        return $this->hasMany(Toefl::class);
    }

    /**
     * Each applicant may have one or more SAT test records.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sats() {
        return $this->hasMany(Sat::class);
    }

    /**
     * Each applicant may have one or more IELTS test records.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ieltss() {
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
     * Each applicant may have one or more ACT test records.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function acts() {
        return $this->hasMany(Act::class);
    }

    /**
     * Compact the applicant's all exam records into an array.
     * @return array
     */
    public function exams() {
        return [
            'toefls' => $this->toefls()->get(),
            'sats' => $this->sats()->get(),
            'satSubjects' => $this->satSubjects()->get(),
            'ieltss' => $this->ieltss()->get(),
            'aps' => $this->aps()->get(),
            'acts' => $this->acts()->get()
        ];
    }

    public function activity() {
        return $this->hasMany(Activity::class);
    }

    public function award() {
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
