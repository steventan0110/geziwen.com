<?php

namespace App\Applicant;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $table = "applicant_exams";

    protected $casts = [
        'score' => 'array'
    ];

    protected $fillable = ['type', 'score', 'remark', 'applicant_id'];

    protected $appends = ['is_standard', 'is_before', 'is_after'];

    public function applicant() {
        return $this->belongsTo(Applicant::class);
    }

    public function getIsStandardAttribute() {
        return $this->remark == 'standard';
    }

    public function getIsBeforeAttribute() {
        return $this->remark == 'before';
    }

    public function getIsAfterAttribute() {
        return $this->remark == 'after';
    }
}