<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\City;
use App\Models\Area;

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
            "token" => $this->userToken,
        ];
        return $return;
    }
}
