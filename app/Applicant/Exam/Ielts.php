<?php

namespace App\Applicant\Exam;

use App\Applicant\Applicant;
use Illuminate\Database\Eloquent\Model;

class Ielts extends Model
{
    protected $table = "applicant_exam_ieltss";

    public function student() {
        $this->belongsTo(Applicant::class);
    }
}
