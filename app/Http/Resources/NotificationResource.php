<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $is_read = $this->read_at ? true : false;
        $return = [
            'id' => $this->id,
            'notifiable_id' => $this->notifiable_id,
            'type' => $this->type,
            'read_at' => $this->read_at ? $this->read_at->diffForHumans() : $this->read_at,
            'seen_at' => $this->seen_at ? $this->seen_at->diffForHumans() : $this->seen_at,
            'is_read' => $is_read,
            'created_at' => $this->created_at->diffForHumans(),
            'data' => $this->data,
        ];

        return $return;
    }
}
