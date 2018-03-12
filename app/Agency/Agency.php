<?php

namespace App\Agency;

use App\Agency\Service\Plan;
use Illuminate\Database\Eloquent\Model;
use App\Applicant\Applicant;

class Agency extends Model
{
    protected $table = "agencies";

    public function applicants() {
        return $this->hasManyThrough(Applicant::class, Plan::class);
    }

    public function plans() {
        return $this->hasMany(Plan::class);
    }
}
