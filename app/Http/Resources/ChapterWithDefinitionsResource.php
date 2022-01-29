<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChapterWithDefinitionsResource extends JsonResource
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
            'topic_id' => $this->topic_id,
            'topic' => $this->topic->title,
            'definitions' => DefinitionResource::collection($this->definitions),
            'tags' => TagResource::collection($this->tags),
        ];
        return $return;
    }
}
