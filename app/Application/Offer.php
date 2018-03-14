<?php

namespace App\Application;

use App\Applicant\Applicant;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
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
}
