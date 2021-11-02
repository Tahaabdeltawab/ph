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
        $area = Area::find($this->area_id);
        $city = City::find($this->city_id);
        if($this->lang == 'ar'){
            $area_name = $area->name_ar;
            $city_name = $city->name_ar;
        }else{
            $area_name = $area->name_en;
            $city_name = $city->name_en;
        }
        $return = [
            "id" => $this->id,
            "username" => $this->username,
            'email' => $this->email,
            "phone" => $this->phone,
            "city_id" => $this->city_id,
            "city_name" =>  $city_name,
            "area_id" => $this->area_id,
            "area_name" => $area_name,
            "token" => $this->userToken,
        ];
        if($request->header('src') == 'web'){
            $return['area_name_ar'] = $area->name_ar;
            $return['area_name_en'] = $area->name_en;
            $return['city_name_ar'] = $city->name_ar;
            $return['city_name_en'] = $city->name_en;
        }
        return $return;
    }
}
