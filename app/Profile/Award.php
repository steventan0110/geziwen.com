<?php

namespace App\Profile;

use Illuminate\Database\Eloquent\Model;
use App\Applicant;

class Award extends Model
{
    protected $table = "awards";

    public function student() {
        $this->belongsTo(Applicant::class);
    }
}
