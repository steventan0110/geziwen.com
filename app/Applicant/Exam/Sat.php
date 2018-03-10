<?php

namespace App\Applicant\Exam;

use App\Applicant\Applicant;
use Illuminate\Database\Eloquent\Model;

class Sat extends Model
{
    protected $table = "sats";

    public function student() {
        $this->belongsTo(Applicant::class);
    }
}
