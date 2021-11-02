<?php

namespace App\Http\Controllers\AdminDash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiResponseTrait;
use App\Http\Controllers\Manage\BaseController;
use carbon\carbon;
use App\Models\User;

class NotifyController extends Controller
{
    use ApiResponseTrait;

    public function show_notifyPage(){
        return view('notify.show');
    }


    public function notify_user(Request $request){
        
        $firebase_token = User::where('id' , $request->user_id)->value('firebase_token');
        $title = $request->title;
        $body = $request->body;
        $image = $request->file('image') ? BaseController::saveImage("notify" , $request->file('image')) : NULL;
        BaseController::send_notification($firebase_token, $title, $body, $image,$request->user_id);

        echo "<script>alert('تم أرسال الرسالة بنجاح');"
                    . "window.location.replace('notify')"
                    . "</script>";
    }


    public function notify_alluser(Request $request){
        
        $firebase_token = User::where('role' , 2)->get();
        $title = $request->title;
        $body = $request->body;
        $image = $request->file('image') ? BaseController::saveImage("notify" , $request->file('image')) : NULL;

        foreach( $firebase_token as $each){
            BaseController::send_notification($each->firebase_token , $title, $body, $image, $each->id);
        }

        echo "<script>alert('تم أرسال الرسالة بنجاح');"
                    . "window.location.replace('notify')"
                    . "</script>";
    }
}
