<?php

namespace App\Applicant\Exam;

use App\Applicant\Applicant;
use Illuminate\Database\Eloquent\Model;

class Toefl extends Model
{
    protected $table = "applicant_exam_toefls";

    public function student() {
        $this->belongsTo(Applicant::class);
    }
}
