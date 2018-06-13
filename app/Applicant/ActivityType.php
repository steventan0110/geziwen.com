<?php

namespace App\Applicant;

use Illuminate\Database\Eloquent\Model;

class ActivityType extends Model
{
    protected $table = "applicant_activity_types";

    protected $visible = ['id', 'name'];

    public function activities() {
        return $this->hasMany(Activity::class);
    }
}
