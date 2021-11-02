<?php

namespace App\Http\Controllers\AdminDash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Privacy_policy;
use Carbon\carbon;

class PolicePrivacyController extends Controller
{

    public function show_policyPage(){
        return view('policyPrivacy.show');
    }


    public function show_policy_data(){
        $data = Privacy_policy::all();

        return view('policyPrivacy.show' , ['data' => $data]);
    }

    public function delete_policy(Request $request){
        $delete_policy = Privacy_policy::where('id' , $request->policy_id)->delete();
        
        echo "<script>alert('تم مسح سياسة الخصوصية بنجاح');"
                    . "window.location.replace('policy')"
                    . "</script>";
    }


    

    public function edit_page(){
        return view('policyPrivacy.edit');
    }

    public function policy_ById(Request $request){

        $data = Privacy_policy::where('id' , $request->policy_id)->get();

        return view('policyPrivacy.edit' , ['data' => $data]);
    }

    public function update_policy (Request $request){

        $created_at = carbon::now()->toDateTimeString();
        $dateTime = date('Y-m-d H:i:s',strtotime('+2 hours',strtotime($created_at)));


        $update = Privacy_policy::where('id' , $request->policy_id)->update([
            "description_ar" => $request->description_ar,
            "description_en" => $request->description_en,
            "updated_at" => $dateTime
        ]);

        if($update == true){
            echo "<script>alert('تم تعديل  سياسة الخصوصية بنجاح');"
                        . "window.location.replace('policy')"
                        . "</script>";
        }else{
            echo "<script>alert('يوجد خطأ حاول مره أخرى');"
                        . "window.location.replace('policy')"
                        . "</script>";
                    
        }

    }


    public function show_addPage(){
        return view('policyPrivacy.addNew');
    }

    public function add_policy(Request $request){

        $created_at = carbon::now()->toDateTimeString();
        $dateTime = date('Y-m-d H:i:s',strtotime('+2 hours',strtotime($created_at)));

        $add = new Privacy_policy;
        $add->description_ar = $request->description_ar;
        $add->description_en = $request->description_en;
        $add->created_at = $dateTime;
        $add->updated_at = $dateTime;
        $add->save();

        if($add == true){
            echo "<script>alert('تم أضافه سياسة الخصوصية بنجاح');"
                        . "window.location.replace('policy')"
                        . "</script>";
        }else{
            echo "<script>alert('يوجد خطأ حاول مره أخرى');"
                        . "window.location.replace('policy')"
                        . "</script>";
                    
        }

    }
}
