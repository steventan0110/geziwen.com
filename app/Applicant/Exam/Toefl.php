<?php

namespace App\Applicant\Exam;

use App\Applicant\Applicant;
use Illuminate\Database\Eloquent\Model;

class Toefl extends Model
{
    protected $table = "toefls";

    public function student() {
        $this->belongsTo(Applicant::class);
    }
}
