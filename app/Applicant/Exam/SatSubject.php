<?php

namespace App\Applicant\Exam;

use App\Applicant\Applicant;
use Illuminate\Database\Eloquent\Model;

class SatSubject extends Model
{
    protected $table = "sat_subjects";

    public function student() {
        $this->belongsTo(Applicant::class);
    }
}
