<?php

namespace App\Agency;

use App\Agency\Service\Plan;
use App\Rating\AgencyRating;
use Illuminate\Database\Eloquent\Model;
use App\Applicant\Applicant;
use App\Teacher\Teacher;
use App\Comment\AgencyComment;

class Agency extends Model
{
    protected $table = "agencies";

    public function applicants() {
        return $this->hasManyThrough(Applicant::class, Plan::class);
    }

    public function plans() {
        return $this->hasMany(Plan::class);
    }

    public function teachers() {
        return $this->hasMany(Teacher::class);
    }

    public function comments() {
        return $this->hasMany(AgencyComment::class);
    }

    public function ratings() {
        return $this->hasMany(AgencyRating::class);
    }

    public function addComment($body) {
        $this->comments()->create(compact('body'));
    }
}
