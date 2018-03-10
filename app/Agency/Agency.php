<?php

namespace App\Agency;

use Illuminate\Database\Eloquent\Model;
use App\Applicant\Applicant;

class Agency extends Model
{
    protected $table = "agencies";

    public function applicants() {
        return $this->hasMany(Applicant::class);
    }
}
