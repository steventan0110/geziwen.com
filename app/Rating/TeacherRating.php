<?php

namespace App\Rating;

use Illuminate\Database\Eloquent\Model;
use App\Teacher\Teacher;

class TeacherRating extends Model
{
    protected $table = "teacher_ratings";

    public function teacher() {
        return $this->belongsTo(Teacher::class);
    }
}
