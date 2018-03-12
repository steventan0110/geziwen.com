<?php

namespace App\Agency\Service;

use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    protected $table = "agency_service_steps";

    public function plan() {
        return $this->belongsTo(Plan::class);
    }
}
