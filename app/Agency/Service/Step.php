<?php

namespace App\Agency\Service;

use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    protected $table = "agency_service_steps";

    protected $fillable = ['name', 'introduction', 'period', 'plan_id'];

    public function plan() {
        return $this->belongsTo(Plan::class);
    }
}
