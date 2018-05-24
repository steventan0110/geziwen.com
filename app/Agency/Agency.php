<?php

namespace App\Agency;

use App\Agency\Service\Plan;
use Illuminate\Database\Eloquent\Model;
use App\Applicant\Applicant;
use App\Comment\Comment;
use Laravel\Scout\Searchable;

class Agency extends Model
{
    use Searchable;

    protected $table = "agencies";

    protected $guarded = ['verified'];

    public function searchableAs() {
        return $this->table."_index";
    }

    public function toSearchableArray() {
        $agency = $this->toArray();
        unset($agency['created_at'], $agency['updated_at']);
        return $agency;
    }

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
        return $this->morphMany(Comment::class, 'commentable');
    }
}
