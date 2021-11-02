<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Favorite_place;
use App\Models\Place_service;
use App\Models\Place_product;
use App\Models\Place_offer;
use App\Models\Place_aboutUs;
use App\Http\Controllers\Manage\BaseController;
use App\Http\Resources\ServicesResource;
use App\Http\Resources\ProductsResource;
use App\Http\Resources\OffersResource;
use App\Http\Resources\productAboutUSResource;


class PlaceDataResources extends JsonResource
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
            $my_place = $this->user_id == auth()->User()->id ? "true" : "false";
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
            "place_services" => ServicesResource::collection(Place_service::where('place_id' , $this->id)->get()),
            "place_products" => ProductsResource::collection(Place_product::where('place_id' , $this->id)->get()),
            "place_offers"   => OffersResource::collection(Place_offer::where('place_id' , $this->id)->get()),
            "place_aboutUS"  => productAboutUSResource::collection(Place_aboutUs::where('place_id' , $this->id)->get()),
        ];

    }
}
