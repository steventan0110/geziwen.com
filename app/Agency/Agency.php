<?php

namespace App\Agency;

use App\Agency\Service\Plan;

use Illuminate\Database\Eloquent\Model;
use App\Applicant\Applicant;
use App\Comment\Comment;

class Agency extends Model
{
    protected $table = "agencies";

    public function applicants($all = false) {
        return $this->hasManyThrough(Applicant::class, Plan::class)
            ->orderBy('id')
            ->offset(0)
            ->limit(5); // TODO: Find a better way of ordering
    }

    public function plans() {
        return $this->hasMany(Plan::class);
    }

    public function teachers() {
        return $this->hasMany(Teacher::class)
            ->orderBy('id')
            ->offset(0)
            ->limit(5); // TODO: Find a better way of ordering
    }

    public function comments() {
        return $this->morphMany('App\Comment\Comment', 'commentable');
    }
}
