<?php

namespace App\Applicant;

use App\Agency\Service\Plan;
use App\Application\Application;
use App\Applicant\Exam\Ap;
use App\Applicant\Exam\Ielts;
use App\Applicant\Exam\Sat;
use App\Applicant\Exam\SatSubject;
use App\Applicant\Exam\Toefl;
use Illuminate\Database\Eloquent\Model;
use App\Agency\Agency;
use App\Teacher\Teacher;

class Applicant extends Model
{

    protected $table = "applicants";

    public function toefl() {
        return $this->hasMany(Toefl::class);
    }

    public function sat() {
        return $this->hasMany(Sat::class);
    }

    public function ielts() {
        return $this->hasMany(Ielts::class);
    }

    public function satSubject() {
        return $this->hasMany(SatSubject::class);
    }

    public function ap() {
        return $this->hasMany(Ap::class);
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

    public function application() {
        return $this->hasMany(Application::class);
    }

    public function plan() {
        return $this->belongsTo(Plan::class);
    }

    public function teachers() {
        return $this->belongsToMany(Teacher::class,'teachers_applicants','teacher_id','applicant_id');
    }
}
