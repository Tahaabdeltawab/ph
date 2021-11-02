<?php

namespace App\Http\Controllers\AdminDash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiResponseTrait;
use carbon\carbon;
use App\Models\Area;
use App\Models\City;

class AreaController extends Controller
{
    use ApiResponseTrait;

    public function show_areaPage(){
        return view('area.show');
    }


    public function show_area_data(Request $request){
        $data = Area::where('city_id' , $request->city_id)->get();

        return view('area.show' , ['data' => $data]);
    }

    public function delete_area(Request $request){
        $delete_cat = Area::where('id' , $request->area_id)->delete();
        
        echo "<script>alert('تم مسح المنطقة بنجاح');"
                    . "window.location.replace('city')"
                    . "</script>";
    }



    
    public function show_addPage(){
        $data = City::all();

        return view('area.addnew' ,['data' => $data]);
    }

    public function Add_area(Request $request){

        $created_at = carbon::now()->toDateTimeString();
        $dateTime = date('Y-m-d H:i:s',strtotime('+2 hours',strtotime($created_at)));

        $add = new Area;
        $add->name_ar = $request->name_ar;
        $add->name_en = $request->name_en;
        $add->city_id = $request->city_id;
        $add->created_at = $dateTime;
        $add->updated_at = $dateTime;
        $add->save();

        if($add == true){
            echo "<script>alert('تم أضافه المنطقة بنجاح');"
                        . "window.location.replace('city')"
                        . "</script>";
        }else{
            echo "<script>alert('يوجد خطأ حاول مره أخرى');"
                        . "window.location.replace('city')"
                        . "</script>";
                    
        }

    }


    
    public function edit_page(){
        return view('area.edit');
    }

    public function area_ById(Request $request){

        $data = Area::where('id' , $request->area_id)->get();

        return view('area.edit' , ['data' => $data]);
    }

    public function update_area (Request $request){

        $created_at = carbon::now()->toDateTimeString();
        $dateTime = date('Y-m-d H:i:s',strtotime('+2 hours',strtotime($created_at)));

        $update = Area::where('id' , $request->area_id)->update([
            "name_ar" => $request->name_ar,
            "name_en" => $request->name_en,
            "updated_at" => $dateTime
        ]);

        if($update == true){
            echo "<script>alert('تم تعديل المنطقة بنجاح');"
                        . "window.location.replace('city')"
                        . "</script>";
        }else{
            echo "<script>alert('يوجد خطأ حاول مره أخرى');"
                        . "window.location.replace('city')"
                        . "</script>";
                    
        }

    }
}
