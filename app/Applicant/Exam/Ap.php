<?php

namespace App\Exam;

use App\Applicant;
use Illuminate\Database\Eloquent\Model;

class Ap extends Model
{
    protected $table = "aps";

    public function student() {
        $this->belongsTo(Applicant::class);
    }
}
