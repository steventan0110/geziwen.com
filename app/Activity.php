<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = "activities";

    public function student() {
         return $this->belongsTo(Applicant::class, 'student', 'id');
    }
}
