<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class reviews extends JsonResource
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
            'course_id'         => $this->pivot->course_id,
            'user_id'           => $this->pivot->user_id,
            'name'              => $this->name,
            'thubnail'          => $this->thubnail,
            'rating'            => $this->pivot->rating,
            'review'            => $this->pivot->review,
            'created_at'        => $this->pivot->created_at,
            'updated_at'        => $this->pivot->updated_at,
        ];
    }
}
