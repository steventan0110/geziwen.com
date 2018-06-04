<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ActivityResource extends JsonResource
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
            'id' => $this->id,
            'type_id' => $this->type_id,
            'name' => $this->name,
            'description' => $this->description,
            'start' => $this->start,
            'end' => $this->end,
            'hours_per_week' =>$this->hours_per_week,
        ];
    }
}
