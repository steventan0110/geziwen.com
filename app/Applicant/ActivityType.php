<?php

namespace App\Applicant;

use Illuminate\Database\Eloquent\Model;

class ActivityType extends Model
{
    protected $table = "applicant_activity_types";

    public function activities() {
        return $this->hasMany(Activity::class);
    }
}
