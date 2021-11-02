<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Favorite_place;
use App\Http\Controllers\Manage\BaseController;

class PlaceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if ( auth()->User()){

            $fav =  Favorite_place::where([['user_id' , auth()->user()->id] , ['place_id' , $this->id]])->first() != NULL ? "true" : "false";
            $my_place = $this->user_id == auth()->User()->id ? True : False;
        }else{
            $fav = "false";
            $my_place = "false";
        }
        return [
            "id" => $this->id,
            "name_en" => $this->name_en,
            "name_ar" => $this->name_ar,
            "image" => BaseController::getImageUrl("places" , $this->image),
            "description_en" => $this->description_en,
            "description_ar" => $this->description_ar,
            "phone" => $this->phone,
            "Longitude" => $this->Longitude,
            "Latitude" => $this->Latitude,
            "isFavorite" => $fav,
            "Facebook" => $this->Facebook,
            "Twitter" => $this->Twitter,
            "my_place" => $my_place, 
        ];
    }
}
