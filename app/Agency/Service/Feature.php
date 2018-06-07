<?php

namespace App\Agency\Service;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $table = "agency_service_features";

    protected $fillable = ['name', 'introduction', 'plan_id'];

    public function agency() {
        return $this->belongsTo(Plan::class);
    }
}
