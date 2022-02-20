<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class McqResultResource extends JsonResource
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
            'user_id' => $this->user_id,
            'user' => $this->user->username,
            'topic_id' => $this->topic_id,
            'topic' => $this->topic->title,
            'chapter_id' => $this->chapter_id,
            'chapter' => $this->chapter ? $this->chapter->title : 'All',
            'mode' => $this->mode,
            'score' => $this->score,
            'data' => json_decode($this->data),
        ];
        return $return;
    }
}