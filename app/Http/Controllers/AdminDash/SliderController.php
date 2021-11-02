<?php

namespace App\Http\Controllers\AdminDash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiResponseTrait;
use App\Http\Controllers\Manage\BaseController;
use App\Models\Slider;
use Carbon\carbon;

class SliderController extends Controller
{
    use ApiResponseTrait;


    public function slider_page(){
        return view('slider.show');
    }

    public function slider_data(){
        $data = Slider::all();

        return view('slider.show' , ['data' => $data]);
    }

    public function delete_image(Request $request){

        $delete = Slider::where('id' , $request->image_id)->delete();

        echo "<script>alert('تم مسح الصوره بنجاح');"
                    . "window.location.replace('slider')"
                    . "</script>";
    }


    public function add_page(){
        return view('slider.addnew');
    }


    public function add_image(Request $request){

        $created_at = carbon::now()->toDateTimeString();
        $dateTime = date('Y-m-d H:i:s',strtotime('+2 hours',strtotime($created_at)));

        $add = new Slider;
        $add->image = $request->file('image') ? BaseController::saveImage("slider" , $request->file('image')) : NULL;
        $add->created_at = $dateTime;
        $add->updated_at = $dateTime;
        $add->save();

        if($add == true){
            echo "<script>alert('تم أضافه صورة بنجاح');"
                        . "window.location.replace('slider')"
                        . "</script>";
        }else{
            echo "<script>alert('يوجد خطأ حاول مره أخرى');"
                        . "window.location.replace('slider')"
                        . "</script>";
                    
        }

    }
    
}
