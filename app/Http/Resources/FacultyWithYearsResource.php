<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FacultyWithYearsResource extends JsonResource
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
            'university_id' => $this->university_id,
            'university' => $this->university->title,
            'years' => YearResource::collection($this->years),
        ];
        return $return;
    }
}
