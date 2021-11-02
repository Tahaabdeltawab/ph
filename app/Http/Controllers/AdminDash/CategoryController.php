<?php

namespace App\Http\Controllers\AdminDash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiResponseTrait;
use App\Models\Category;
use carbon\carbon;
use App\Http\Controllers\Manage\BaseController;

class CategoryController extends Controller
{
    use ApiResponseTrait;

    public function show_categoryPage(){
        return view('category.show');
    }


    public function show_category_data(){
        $data = Category::all();

        return view('category.show' , ['data' => $data]);
    }

    public function delete_category(Request $request){
        $delete_cat = Category::where('id' , $request->category_id)->delete();
        
        echo "<script>alert('تم مسح القسم بنجاح');"
                    . "window.location.replace('category')"
                    . "</script>";
    }

    public function show_addPage(){
        return view('category.addnew');
    }

    public function add_category(Request $request){

        $created_at = carbon::now()->toDateTimeString();
        $dateTime = date('Y-m-d H:i:s',strtotime('+2 hours',strtotime($created_at)));

        $add = new category;
        $add->name_ar = $request->name_ar;
        $add->name_en = $request->name_en;
        $add->image = $request->file('image') ? BaseController::saveImage("category" , $request->file('image')) : NULL;
        $add->created_at = $dateTime;
        $add->updated_at = $dateTime;
        $add->save();

        if($add == true){
            echo "<script>alert('تم أضافه القسم بنجاح');"
                        . "window.location.replace('category')"
                        . "</script>";
        }else{
            echo "<script>alert('يوجد خطأ حاول مره أخرى');"
                        . "window.location.replace('category')"
                        . "</script>";
                    
        }

    }


    public function edit_page(){
        return view('category.edit');
    }

    public function catgeory_ById(Request $request){

        $data = Category::where('id' , $request->category_id)->get();

        return view('category.edit' , ['data' => $data]);
    }

    public function update_category (Request $request){

        $created_at = carbon::now()->toDateTimeString();
        $dateTime = date('Y-m-d H:i:s',strtotime('+2 hours',strtotime($created_at)));

        $data_image = category::where('id' , $request->category_id)->value('image');

        $update = category::where('id' , $request->category_id)->update([
            "name_ar" => $request->name_ar,
            "name_en" => $request->name_en,
            "image" => $request->file('image') ? BaseController::saveImage("category" , $request->file('image')) : $data_image,
            "updated_at" => $dateTime
        ]);

        if($update == true){
            echo "<script>alert('تم تعديل القسم بنجاح');"
                        . "window.location.replace('category')"
                        . "</script>";
        }else{
            echo "<script>alert('يوجد خطأ حاول مره أخرى');"
                        . "window.location.replace('category')"
                        . "</script>";
                    
        }

    }
}
