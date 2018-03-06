<?php

namespace App;

use App\Test\Ap;
use App\Test\Ielts;
use App\Test\Sat;
use App\Test\SatSubject;
use App\Test\Toefl;
use Illuminate\Database\Eloquent\Model;
use App\Profile\Award;
use App\Profile\Activity;
use App\Agency;

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
}
