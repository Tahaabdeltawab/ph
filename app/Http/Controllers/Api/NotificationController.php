<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Http\Resources\notifyResources;

class NotificationController extends Controller
{
    use ApiResponseTrait;


    public function show_all_notification(Request $request){
        $lang = $request->header('lang');
        
        if(auth()->User()){
            $data = Notification::where('user_id' , auth()->user()->id)->get();

            return $this->apiResponseData( notifyResources::collection($data) , "all Notification data");

        }else{
            $msg = $lang == 'ar' ? " من فضلك سجل دخول" : "Token is not provided";

            return $this->apiResponseMessage( 3, $msg);
        }
    }
}
