<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Controllers\Manage\BaseController;

class notifyResources extends JsonResource
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
            "title_ar" => $this->title_ar,
            "body_ar" => $this->body_ar,
            "image" => $this->image == NULL ? NULL : BaseController::getImageUrl("notify" , $this->image),
            "user_id" => $this->user_id,
            "created_at" => $this->created_at,
        ];
    }
}
