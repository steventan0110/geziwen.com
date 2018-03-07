<?php

namespace App\Admission;

use App\Applicant;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $table = "applications";

    public function applicant() {
        return $this->belongsTo(Applicant::class);
    }

    public function university() {
        return $this->belongsTo(University::class);
    }

    public function plan() {
        return $this->belongsTo(Plan::class);
    }

    public function decision() {
        return $this->belongsTo(Decision::class);
    }
}
