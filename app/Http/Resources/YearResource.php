<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class YearResource extends JsonResource
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
            'code' => $this->code,
            'faculty_id' => $this->faculty_id,
            'faculty' => $this->faculty->title,
        ];
        return $return;
    }
}
