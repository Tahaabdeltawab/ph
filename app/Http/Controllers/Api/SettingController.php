<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\SettingResources;
use App\Models\Setting;

class SettingController extends Controller
{
    use ApiResponseTrait;

    public function show_user_setting(Request $request){

        $lang = $request->header('lang');
        if(auth()->User()){

            $user_setting = Setting::where('user_id' , auth()->User()->id)->first();

            return $this->apiResponseData( SettingResources::make($user_setting) , "user setting");

        }else{
            $msg = $lang == 'ar' ? " من فضلك سجل دخول" : "Token is not provided";

            return $this->apiResponseMessage( 3, $msg);
        }
    }

    public function update_setting (Request $request){
        $lang = $request->header('lang');
        if(auth()->User()){

            $user_setting = Setting::where('user_id' , auth()->User()->id)->first();

            $notify = $request->has('notification') && $request->notification != NULL ? $request->notification : $user_setting->notification;

            $update_data = Setting::where('user_id' , auth()->user()->id)->update(["notification" => $notify]);
           
            $msg = $lang == 'ar' ? " تم تعديل العدادات" : "Setting is updated";

            return $this->apiResponseMessage( 0, $msg);

        }else{
            $msg = $lang == 'ar' ? " من فضلك سجل دخول" : "Token is not provided";

            return $this->apiResponseMessage( 3, $msg);
        }
    }
}
