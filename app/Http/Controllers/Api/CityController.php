<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
use App\Http\Resources\CityResource;

class CityController extends Controller
{
    use ApiResponseTrait;

    public function show_all_city(Request $request){
        
        $lang = $request->header('lang');
       
        $data = City::all();

        $msg = $lang== "ar" ? "كل المحافظات" : "all city";
        
        return $this->apiResponseData( CityResource::collection($data) , $msg);
    }
}
