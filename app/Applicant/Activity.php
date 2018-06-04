<?php

namespace App\Applicant;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = "applicant_activities";

    protected $fillable = ['name', 'description', 'start', 'end', 'type_id', 'applicant_id'];

    public function applicant() {
         return $this->belongsTo(Applicant::class);
    }

    public function type() {
        return $this->belongsTo(ActivityType::class, 'type_id', 'id');
    }
}
