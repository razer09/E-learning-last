<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Video extends JsonResource
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
            'section_id'    => $this->section_id,
            'url'           => $this->url,
            'show'          => $this->show,
            'completedBy'    => $this->completion->pluck('id'),
        ];
    }
}


