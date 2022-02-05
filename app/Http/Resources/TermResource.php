<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TermResource extends JsonResource
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
            'definition_id' => $this->definition_id,
            'definition' => $this->definition->title,
            'topic_id' => $this->definition->topic_id,
            'topic' => $this->definition->topic->title,
            'chapter_id' => $this->definition->chapter_id,
            'chapter' => $this->definition->chapter->title,
        ];
        return $return;
    }
}
