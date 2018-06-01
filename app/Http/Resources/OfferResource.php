<?php

namespace App\Http\Resources;

use App\Http\Controllers\Agency\PlanApplicantsController;
use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'university' => new UniversityResource($this->university),
            'plan' => new PlanResource($this->plan),
        ];
    }
}
