<?php

namespace App\Test;

use App\Applicant;
use Illuminate\Database\Eloquent\Model;

class Ielts extends Model
{
    protected $table = "ieltss";

    public function student() {
        $this->belongsTo(Applicant::class);
    }
}
