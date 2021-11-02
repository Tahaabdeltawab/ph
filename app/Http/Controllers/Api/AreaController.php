<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Area;
use App\Http\Resources\CityResource;

class AreaController extends Controller
{
    use ApiResponseTrait;

    public function show_Area_byCityId(Request $request){

        $lang = $request->header('lang');

        $data = Area::where('city_id' , $request->city_id)->get();

        $msg = $lang== "ar" ? "كل المناطق" : "all Area";

        return $this->apiResponseData( CityResource::collection($data) , $msg);

    }
}
