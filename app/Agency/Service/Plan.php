<?php

namespace App\Agency\Service;

use App\Agency\Agency;
use App\Applicant\Applicant;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Plan extends Model
{
    use Searchable;

    protected $table = "agency_service_plans";

    public function searchableAs() {
        return $this->table.'_index';
    }

    public function toSearchableArray() {
        $plan = $this->toArray();
        $plan['agency'] = [
            'name' => $this->agency->name,
            'introduction' => $this->agency->introduction
        ];
        $plan['steps'] = $this->steps->map(function ($step) {
            return [
                'name' => $step['name'],
                'introduction' => $step['introduction']
            ];
        })->toArray();
        unset($plan['created_at'], $plan['updated_at'], $plan['agency_id'], $plan['picture']);
        return $plan;
    }

    public function steps() {
        return $this->hasMany(Step::class);
    }

    public function features() {
        return $this->hasMany(Feature::class);
    }

    public function agency() {
        return $this->belongsTo(Agency::class);
    }

    public function applicants() {
        return $this->hasMany(Applicant::class);
    }
}
