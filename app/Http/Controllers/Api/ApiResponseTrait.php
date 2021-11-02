<?php

namespace App\Http\Controllers\Api;

trait ApiResponseTrait
{

    public function apiResponseData($data = null, $message = null, $code = 200)
    {
        return response()->json(['error'=>0, 'data'=>$data,'message'=>$message],200);
    }


    public function apiResponseMessage( $error,$message = null,$code = 200)
    {
        $array = [
            'error' =>  $error,
            'message' => $message,
            'data'=>null,
        ];
        return response($array, 200);
    }

    public function not_found($array,$arabic,$english,$lang){
        if(is_null($array)){
            $msg=$lang=='ar' ? $arabic . ' غير موجود' : $english .' not found';
            return response()->json(['error'=>1,'message'=>$msg,'data'=>null],200);
        }
    }
}