<?php

namespace App\Http\Controllers\AdminDash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usage_agreement;
use Carbon\carbon;

class UsageAgreementController extends Controller
{

    public function show_agreementPage(){
        return view('usageAgrement.show');
    }


    public function show_agreement_data(){
        $data = Usage_agreement::all();

        return view('usageAgrement.show' , ['data' => $data]);
    }

    public function delete_agreement(Request $request){
        $delete_policy = Usage_agreement::where('id' , $request->usage_id)->delete();
        
        echo "<script>alert('تم مسح أتفاقية الاستخدام بنجاح');"
                    . "window.location.replace('agreement')"
                    . "</script>";
    }


    

    public function edit_page(){
        return view('usageAgrement.edit');
    }

    public function agreement_ById(Request $request){

        $data = Usage_agreement::where('id' , $request->usage_id)->get();

        return view('usageAgrement.edit' , ['data' => $data]);
    }

    public function update_agreement (Request $request){

        $created_at = carbon::now()->toDateTimeString();
        $dateTime = date('Y-m-d H:i:s',strtotime('+2 hours',strtotime($created_at)));


        $update = Usage_agreement::where('id' , $request->usage_id)->update([
            "description_ar" => $request->description_ar,
            "description_en" => $request->description_en,
            "updated_at" => $dateTime
        ]);

        if($update == true){
            echo "<script>alert('تم تعديل أتفاقية الاستخدام بنجاح');"
                        . "window.location.replace('agreement')"
                        . "</script>";
        }else{
            echo "<script>alert('يوجد خطأ حاول مره أخرى');"
                        . "window.location.replace('agreement')"
                        . "</script>";
                    
        }

    }


    public function show_addPage(){
        return view('usageAgrement.addNew');
    }

    public function add_agreement(Request $request){

        $created_at = carbon::now()->toDateTimeString();
        $dateTime = date('Y-m-d H:i:s',strtotime('+2 hours',strtotime($created_at)));

        $add = new Usage_agreement;
        $add->description_ar = $request->description_ar;
        $add->description_en = $request->description_en;
        $add->created_at = $dateTime;
        $add->updated_at = $dateTime;
        $add->save();

        if($add == true){
            echo "<script>alert('تم أضافه أتفاقية الاستخدام بنجاح');"
                        . "window.location.replace('agreement')"
                        . "</script>";
        }else{
            echo "<script>alert('يوجد خطأ حاول مره أخرى');"
                        . "window.location.replace('agreement')"
                        . "</script>";
                    
        }

    }
}
