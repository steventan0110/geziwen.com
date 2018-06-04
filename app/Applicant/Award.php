<?php

namespace App\Applicant;

use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
    protected $table = "applicant_awards";

    protected $fillable = ['name', 'description', 'received_on', 'applicant_id'];

    public function applicant() {
        $this->belongsTo(Applicant::class);
    }
}
