<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\completedVideo as VideoResource;

class Course extends JsonResource
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
            'course'    =>[
                'id'            => $this->id,
                'user_id'       => $this->user_id,
                'title'         => $this->title,
                'description'   => $this->description,
                'thubnail'      => $this->thubnail,
                'old_price'     => $this->old_price,
                'price'         => $this->price,
                'nbr_student'   => $this->students->count(),
                'last_update'   => $this->updated_at->month.'/'.$this->updated_at->year,
                'nbr_lessons'   => $this->videos->count(),
                'nbr_hours'     => '25 Hours'
            ],
            'teacher'       => $this->teacher->only(['id', 'name', 'email']),
            'students'      => $this->students->map->only(['id', 'name', 'email']),
            'sections'      => $this->selectSections(),
            'completedBy'   => $this->completedBy(),
            'tags'          => $this->tags->map->only(['id', 'name']),
        ];
    }

    public function selectSections()
    {
        return $this->sections()
                    ->with('videos:id,name,url,section_id')
                    ->get(['id','name']);
    }

    public function completedBy()
    {
        $videos =  $this->videos;
        return VideoResource::collection($videos);
    }
}
