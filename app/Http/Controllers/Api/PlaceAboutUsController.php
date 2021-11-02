<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\productAboutUSResource;
use App\Models\Place_aboutUs;
use carbon\carbon;
use Validator,Auth,Artisan,Hash,File,Crypt;

class PlaceAboutUsController extends Controller
{
    use ApiResponseTrait;

    public function update_place_aboutUs(Request $request){
        $lang = $request->header('lang');

        if(auth()->User()){
            $created_at = carbon::now()->toDateTimeString();
            $dateTime = date('Y-m-d H:i:s',strtotime('+2 hours',strtotime($created_at)));

            $about_id = $request->about_id;
            $data = Place_aboutUs::where('id' , $about_id)->first();

            $check = $this->not_found($data , 'نبذ عنك', 'AboutUs' , $lang);
            if( isset($check) ){
                return $check;
            }
            

            $details_en = $request->has('details_en') && $request->details_en != NULL ? $request->details_en : $data->details_en;
            $details_ar = $request->has('details_ar') && $request->details_ar != NULL ? $request->details_ar : $data->details_ar;

            $update_data = Place_aboutUs::where('id' , $about_id)->update([
                                                                    "details_en" => $details_en,
                                                                    "details_ar" => $details_ar,
                                                                    "updated_at" => $dateTime,    
                                                                    ]);

            $msg = $lang == 'ar' ? " تم تعديل البيانات بنجاح" : "Data is updated";

            return $this->apiResponseMessage( 0, $msg);

        }else{
            $msg = $lang == 'ar' ? " من فضلك سجل دخول" : "Token is not provided";

            return $this->apiResponseMessage( 3, $msg);
        }
    }



    public function add_place_aboutUS(Request $request){
        $lang = $request->header('lang');

        if(auth()->User()){
            $created_at = carbon::now()->toDateTimeString();
            $dateTime = date('Y-m-d H:i:s',strtotime('+2 hours',strtotime($created_at)));

            $input = $request->all();
            $validationMessages = [
                'details_ar.required' => $lang == 'ar' ?  'من فضلك ادخل نبذ عنك باللغه العربية' :"please enter about us in arabic" ,        
                'details_en.required' => $lang == 'ar' ?  'من فضلك ادخل نبذ عنك باللغه الانحليزية' :"please enter about us in english" ,      
            ];

            $validator = Validator::make($input, [
                'details_en' => 'required',
                'details_ar' => 'required',
            ], $validationMessages);

            if ($validator->fails()) {
                return $this->apiResponseMessage(1,$validator->messages()->first(), 200);
            }

            $add =  new Place_aboutUs;
            $add->details_en = $request->details_en;
            $add->details_ar = $request->details_ar;
            $add->place_id = $request->place_id;
            $add->created_at = $dateTime;
            $add->updated_at = $dateTime;
            $add->save();

            $msg = $lang == 'ar' ? " تم أضافه معلومات جديده" : "About us is inserted";
            if($request->header('src') == 'web')
            return $this->apiResponseData( new productAboutUSResource($add), $msg);
            return $this->apiResponseMessage( 0, $msg);

        }else{
            $msg = $lang == 'ar' ? " من فضلك سجل دخول" : "Token is not provided";

            return $this->apiResponseMessage( 3, $msg);
        }

    }


    public function delete_aboutUS(Request $request){
        $lang = $request->header('lang');

        if(auth()->User()){
            $about_id = $request->about_id;

            $data = Place_aboutUs::where('id' , $about_id)->first();

            $check = $this->not_found($data , 'نبذ عنك', 'AboutUs' , $lang);
            if( isset($check) ){
                return $check;
            }
         
            $delete_service = Place_aboutUs::where('id' , $about_id)->delete();

            $msg = $lang == 'ar' ? "تم مسح معلومات بنجاح" : "About us is deleted";

            return $this->apiResponseMessage( 0, $msg);

        }else{
            $msg = $lang == 'ar' ? " من فضلك سجل دخول" : "Token is not provided";

            return $this->apiResponseMessage( 3, $msg);
        }
    }
}
