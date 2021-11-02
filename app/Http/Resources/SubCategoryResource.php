<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Controllers\Manage\BaseController;

class SubCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "name_en" => $this->name_en,
            "name_ar" => $this->name_ar,
            "image" => BaseController::getImageUrl("category" , $this->image),
            "sub_image" =>BaseController::getImageUrl("category" , $this->sub_image),

        ];
    }
}
