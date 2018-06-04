<?php

namespace App\Http\Resources;

use App\Agency\Agency;
use App\Agency\Teacher;
use Illuminate\Http\Resources\Json\JsonResource;

class AgencyResource extends JsonResource
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
            'applicants' => $this->applicants()->limit(3)->get(),
            'teachers' => $this->teachers()->limit(5)->get(),
        ];
    }


}
