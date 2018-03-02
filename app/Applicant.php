<?php

namespace App;

use App\Test\Ap;
use App\Test\Ielts;
use App\Test\Sat;
use App\Test\SatSubject;
use App\Test\Toefl;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{

    protected $table = "applicants";

    public function toefl() {
        return $this->hasMany(Toefl::class, 'student', 'id');
    }

    public function sat() {
        return $this->hasMany(Sat::class, 'student', 'id');
    }

    public function ielts() {
        return $this->hasMany(Ielts::class, 'student', 'id');
    }

    public function satSubject() {
        return $this->hasMany(SatSubject::class, 'student', 'id');
    }

    public function ap() {
        return $this->hasMany(Ap::class, 'student', 'id');
    }

    public function activity() {
        return $this->hasMany(Activity::class, 'student', 'id');
    }

    public function award() {
        return $this->hasMany(Award::class, 'student', 'id');
    }

}