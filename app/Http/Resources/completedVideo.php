<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class completedVideo extends JsonResource
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
            'video_id'    => $this->id,
            'completedBy'    => $this->completion->pluck('id'),
        ];
    }
}
