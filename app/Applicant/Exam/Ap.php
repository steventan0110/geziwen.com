<?php

namespace App\Applicant\Exam;

use Illuminate\Database\Eloquent\Model;
use App\Applicant\Applicant;

class Ap extends Model
{
    protected $table = "aps";

    public function student() {
        $this->belongsTo(Applicant::class);
    }
}
