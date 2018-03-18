<?php

namespace App\Applicant\Exam;

use App\Applicant\Applicant;
use Illuminate\Database\Eloquent\Model;

class Act extends Model
{
    protected $table = "applicant_exam_acts";

    public function applicant() {
        return $this->belongsTo(Applicant::class);
    }
}
