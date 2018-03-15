<?php

namespace App\Rating;

use App\Agency\Agency;
use Illuminate\Database\Eloquent\Model;

class AgencyRating extends Model
{
    protected $table = "agency_ratings";

    public function agency() {
        return $this->belongsTo(Agency::class);
    }
}
