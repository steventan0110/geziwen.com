<?php

namespace App\Applicant;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = "applicant_activities";

    public function applicant() {
         return $this->belongsTo(Applicant::class);
    }

    public function type() {
        return $this->belongsTo(ActivityType::class, 'type_id', 'id');
    }
}
