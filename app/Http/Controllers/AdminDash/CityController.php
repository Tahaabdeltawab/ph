<?php

namespace App\Http\Controllers\AdminDash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiResponseTrait;
use carbon\carbon;
use App\Models\City;
use App\Models\Area;

class CityController extends Controller
{
    use ApiResponseTrait;


    public function show_cityPage(){
        return view('city.show');
    }


    public function show_city_data(){
        $data = City::all();

        return view('city.show' , ['data' => $data]);
    }

    public function delete_city(Request $request){
        $delete_cat = City::where('id' , $request->city_id)->delete();
        
        echo "<script>alert('تم مسح المدينة بنجاح');"
                    . "window.location.replace('city')"
                    . "</script>";
    }

    public function show_addPage(){
        return view('city.addnew');
    }

    public function add_city(Request $request){

        $created_at = carbon::now()->toDateTimeString();
        $dateTime = date('Y-m-d H:i:s',strtotime('+2 hours',strtotime($created_at)));

        $add = new City;
        $add->name_ar = $request->name_ar;
        $add->name_en = $request->name_en;
        $add->created_at = $dateTime;
        $add->updated_at = $dateTime;
        $add->save();

        if($add == true){
            echo "<script>alert('تم أضافه المدينة بنجاح');"
                        . "window.location.replace('city')"
                        . "</script>";
        }else{
            echo "<script>alert('يوجد خطأ حاول مره أخرى');"
                        . "window.location.replace('city')"
                        . "</script>";
                    
        }

    }

    public function edit_page(){
        return view('city.edit');
    }

    public function city_ById(Request $request){

        $data = City::where('id' , $request->city_id)->get();

        return view('city.edit' , ['data' => $data]);
    }

    public function update_city (Request $request){

        $created_at = carbon::now()->toDateTimeString();
        $dateTime = date('Y-m-d H:i:s',strtotime('+2 hours',strtotime($created_at)));


        $update = City::where('id' , $request->city_id)->update([
            "name_ar" => $request->name_ar,
            "name_en" => $request->name_en,
            "updated_at" => $dateTime
        ]);

        if($update == true){
            echo "<script>alert('تم تعديل المدينة بنجاح');"
                        . "window.location.replace('city')"
                        . "</script>";
        }else{
            echo "<script>alert('يوجد خطأ حاول مره أخرى');"
                        . "window.location.replace('city')"
                        . "</script>";
                    
        }

    }

}
