<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Place_offer;
use Validator,Auth,Artisan,Hash,File,Crypt;
use carbon\Carbon;
use App\Http\Resources\OffersResource;

class OffersController extends Controller
{
    use ApiResponseTrait;

    public function update_offers(Request $request){
        $lang = $request->header('lang');

        if(auth()->User()){

            $created_at = carbon::now()->toDateTimeString();
            $dateTime = date('Y-m-d H:i:s',strtotime('+2 hours',strtotime($created_at)));

            $offer_id = $request->offer_id;

            $data = Place_offer::where('id' , $offer_id)->first();

            $check = $this->not_found($data , 'العرض', 'Offers' , $lang);
            if( isset($check) ){
                return $check;
            }
            
            $title_en = $request->has('title_en') && $request->title_en != NULL ? $request->title_en : $data->title_en;
            $title_ar = $request->has('title_ar') && $request->title_arx != NULL ? $request->title_ar : $data->title_ar;
            $code = $request->has('code') && $request->code != NULL ? $request->code : $data->code;
            $present = $request->has('present') && $request->present != NULL ? $request->present : $data->present;
            
            $update_offer = Place_offer::where('id' , $offer_id)->update([
                                                                        "title_en" => $title_en,
                                                                        "title_ar" => $title_ar,
                                                                        "code" => $code,
                                                                        "present" => $present,
                                                                        "updated_at" => $dateTime,
                                                                        ]);

            $msg = $lang == 'ar' ? " تم تعديل بيانات العرض" : "Offer is updated";

            return $this->apiResponseMessage( 0, $msg);

        }else{
            $msg = $lang == 'ar' ? " من فضلك سجل دخول" : "Token is not provided";

            return $this->apiResponseMessage( 3, $msg);
        }

    }

    public function add_offers(Request $request){
        $lang = $request->header('lang');

        if(auth()->User()){
            $created_at = carbon::now()->toDateTimeString();
            $dateTime = date('Y-m-d H:i:s',strtotime('+2 hours',strtotime($created_at)));

            $input = $request->all();
            $validationMessages = [
                'title_ar.required' => $lang == 'ar' ?  'من فضلك ادخل عنوان العرض باللغه العربية' :"please enter offer title in arabic" ,        
                'title_en.required' => $lang == 'ar' ?  'من فضلك ادخل  عنوان العرض باللغه الانحليزية' :"please enter offer title in english" ,      
                'code.required' => $lang == 'ar' ?  'من فضلك ادخل كود العرض باللغه الانحليزية' :"please enter ofer code in english" ,      
                'present.required' => $lang == 'ar' ?  'من فضلك ادخل نسبه العرض باللغه الانحليزية' :"please enter offer presentage in english" ,      
                'present.numeric' => $lang == 'ar' ?  ' النسبه يجب ان تكون رقما' :"The Presentage must be a number" ,
            ];

            $validator = Validator::make($input, [
                'title_ar' => 'required',
                'title_en' => 'required',
                'code' => 'required',
                'present' => 'required|numeric',
            ], $validationMessages);

            if ($validator->fails()) {
                return $this->apiResponseMessage(1,$validator->messages()->first(), 200);
            }
            
            $add = new Place_offer;
            $add->title_ar = $request->title_ar;
            $add->title_en = $request->title_en;
            $add->code = $request->code;
            $add->present = $request->present;
            $add->place_id = $request->place_id;
            $add->created_at = $dateTime;
            $add->updated_at = $dateTime;
            $add->save();
          
            $msg = $lang == 'ar' ? " تم أضافه عرض جديده" : "new Offer is inserted";
            if($request->header('src') == 'web')
            return $this->apiResponseData( new OffersResource($add), $msg);
            return $this->apiResponseMessage( 0, $msg);

        }else{
            $msg = $lang == 'ar' ? " من فضلك سجل دخول" : "Token is not provided";

            return $this->apiResponseMessage( 3, $msg);
        }
    }


    public function delete_Offer(Request $request){
        $lang = $request->header('lang');

        if(auth()->User()){
            $offer_id = $request->offer_id;

            $data = Place_offer::where('id' , $offer_id)->first();

            $check = $this->not_found($data , 'العرض', 'Offer' , $lang);
            if( isset($check) ){
                return $check;
            }
         
            $delete_offer = Place_offer::where('id' , $offer_id)->delete();

            $msg = $lang == 'ar' ? "تم مسح العرض بنجاح" : "Offer is deleted";

            return $this->apiResponseMessage( 0, $msg);

        }else{
            $msg = $lang == 'ar' ? " من فضلك سجل دخول" : "Token is not provided";

            return $this->apiResponseMessage( 3, $msg);
        }
    }
}
