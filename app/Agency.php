<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    protected $table = "agencies";

    public function applicants() {
        return $this->hasMany(Applicant::class, 'agency', 'id');
    }
}
