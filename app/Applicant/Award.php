<?php

namespace App\Applicant;

use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
    protected $table = "awards";

    public function student() {
        $this->belongsTo(Applicant::class);
    }
}
