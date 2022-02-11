<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            "username" => $this->username,
            'email' => $this->email,
            "phone" => $this->phone,
            "roles" => $this->roles->pluck('name'),
            "permissions" => $this->allPermissions(['name'])->pluck('name'),
            "status" => $this->status,
            "university_id" => $this->university_id,
            "faculty_id" => $this->faculty_id,
            "year_id" => $this->year_id,
            "university" => @$this->university->title,
            "faculty" => @$this->faculty->title,
            "year" => @$this->year->title,
        ];
        return $return;
    }
}
