<?php

namespace App\Http\Controllers\AdminDash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiResponseTrait;
use App\Http\Controllers\Manage\BaseController;
use carbon\carbon;
use App\Models\SubCategory;
use App\Models\Category;

class SubCategoryController extends Controller
{
    use ApiResponseTrait;

    public function show_subcategoryPage(){
        return view('subcategory.show');
    }


    public function show_subcategory_data(Request $request){
        $data = SubCategory::where('category_id' , $request->category_id)->get();

        return view('subcategory.show' , ['data' => $data]);
    }

    public function delete_subcategory(Request $request){
        $delete_cat = SubCategory::where('id' , $request->subcategory_id)->delete();
        
        echo "<script>alert('تم مسح القسم بنجاح');"
                    . "window.location.replace('category')"
                    . "</script>";
    }



    public function show_addPage(){
        $data = Category::all();

        return view('subcategory.addnew' ,['data' => $data]);
    }

    public function add_subcategory(Request $request){

        $created_at = carbon::now()->toDateTimeString();
        $dateTime = date('Y-m-d H:i:s',strtotime('+2 hours',strtotime($created_at)));

        $add = new SubCategory;
        $add->name_ar = $request->name_ar;
        $add->name_en = $request->name_en;
        $add->image = $request->file('image') ? BaseController::saveImage("category" , $request->file('image')) : NULL;
        $add->sub_image = $request->file('sub_image') ? BaseController::saveImage("category" , $request->file('sub_image')) : NULL;
        $add->category_id = $request->category_id;
        $add->created_at = $dateTime;
        $add->updated_at = $dateTime;
        $add->save();

        if($add == true){
            echo "<script>alert('تم أضافه القسم الفرعى بنجاح');"
                        . "window.location.replace('category')"
                        . "</script>";
        }else{
            echo "<script>alert('يوجد خطأ حاول مره أخرى');"
                        . "window.location.replace('category')"
                        . "</script>";
                    
        }

    }



    
    public function edit_page(){
        return view('subcategory.edit');
    }

    public function subcatgeory_ById(Request $request){

        $data = SubCategory::where('id' , $request->subcategory_id)->get();

        return view('subcategory.edit' , ['data' => $data]);
    }

    public function update_subcategory (Request $request){

        $created_at = carbon::now()->toDateTimeString();
        $dateTime = date('Y-m-d H:i:s',strtotime('+2 hours',strtotime($created_at)));

        $data_image = SubCategory::where('id' , $request->subcategory_id)->value('image');
        $data_subimage = SubCategory::where('id' , $request->subcategory_id)->value('sub_image');

        $update = SubCategory::where('id' , $request->subcategory_id)->update([
            "name_ar" => $request->name_ar,
            "name_en" => $request->name_en,
            "image" => $request->file('image') ? BaseController::saveImage("category" , $request->file('image')) : $data_image,
            "sub_image" => $request->file('sub_image') ? BaseController::saveImage("category" , $request->file('sub_image')) : $data_subimage,
            "updated_at" => $dateTime
        ]);

        if($update == true){
            echo "<script>alert('تم تعديل القسم الفرعى بنجاح');"
                        . "window.location.replace('category')"
                        . "</script>";
        }else{
            echo "<script>alert('يوجد خطأ حاول مره أخرى');"
                        . "window.location.replace('category')"
                        . "</script>";
                    
        }

    }

}
