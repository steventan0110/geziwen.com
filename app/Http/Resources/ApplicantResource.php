<?php

namespace App\Http\Resources;

use App\Application\Offer;
use Illuminate\Http\Resources\Json\JsonResource;

class ApplicantResource extends JsonResource
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
            'offers' => OfferResource::collection($this->offers),
            'activities' => ActivityResource::collection($this->activities),
            'exams' => ExamResource::collection($this->exams),
            'awards' => AwardResource::collection($this->awards),
            'teachers' => $this->teachers,
            'agency' => $this->plan->agency,
        ];
    }
}
