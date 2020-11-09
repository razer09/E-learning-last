<?php

namespace App\Http\Resources;

use App\Http\Resources\completedVideo as VideoResource;
use Illuminate\Http\Resources\Json\JsonResource;

class Courses extends JsonResource
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
            'id'            => $this->id,
            'user_id'       => $this->user_id,
            'title'         => $this->title,
            'description'   => $this->description,
            'thubnail'      => $this->thubnail,
            'old_price'     => $this->old_price,
            'price'         => $this->price,
            'nbr_student'   => $this->students->count(),
            'last_update'   => $this->updated_at,
            'teacher'       => $this->teacher->only(['id','name']),
            'sections'      => $this->sections->count(),
            'last_update'   => $this->updated_at->month.'/'.$this->updated_at->year,
            'nbr_lessons'   => $this->videos->count(),
            'nbr_hours'     => '25 Hours',
            'completedBy'  => VideoResource::collection($this->videos),
        ];
    }
}
