<?php

namespace App\Applicant\Exam;

use Illuminate\Database\Eloquent\Model;
use App\Applicant\Applicant;

class Ap extends Model
{
    protected $table = "applicant_exam_aps";

    public function student() {
        $this->belongsTo(Applicant::class);
    }
}
