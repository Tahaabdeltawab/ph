<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TopicWithChaptersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $return = [
            "id" => $this->id,
            "title" => $this->title,
            'year_id' => $this->year_id,
            'year' => $this->year->title,
            'chapters' => ChapterResource::collection($this->chapters),
        ];
        return $return;
    }
}
