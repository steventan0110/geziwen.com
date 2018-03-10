<?php

namespace App\Profile;

use App\Applicant;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = "activities";

    public function applicant() {
         return $this->belongsTo(Applicant::class);
    }

    public function type() {
        return $this->belongsTo(ActivityType::class, 'type_id', 'id');
    }
}
