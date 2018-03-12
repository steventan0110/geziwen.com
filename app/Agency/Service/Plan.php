<?php

namespace App\Agency\Service;

use App\Agency\Agency;
use App\Applicant\Applicant;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $table = "agency_service_plans";

    public function steps() {
        return $this->hasMany(Step::class);
    }

    public function agency() {
        return $this->belongsTo(Agency::class);
    }

    public function applicants() {
        return $this->hasMany(Applicant::class);
    }
}
