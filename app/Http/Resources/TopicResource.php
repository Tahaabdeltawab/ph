<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TopicResource extends JsonResource
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
            'visibility' => $this->visibility,
            'user_id' => $this->user_id,
            'user' => @$this->user->username,
            'year_id' => $this->year_id,
            'year' => $this->year ? $this->year->title : null,
        ];
        return $return;
    }
}
