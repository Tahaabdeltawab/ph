<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use carbon\carbon;
use JWTFactory;
use JWTAuth;
use JWT;
use Tymon\JWTAuthExceptions\JWTException;
use Tymon\JWTAuth\Contracts\JWTSubject as JWTSubject;
use Validator,Auth,Artisan,Hash,File,Crypt;
use \App\Models\User;
use \App\Models\City;
use \App\Models\Area;
use \App\Models\Setting;
use App\Http\Resources\UserResource;

class AuthController extends APIBaseController
{
    use ApiResponseTrait;

    public function registration (Request $request){
        

        $lang = $request->header('lang');
        $input = $request->all();
        $validationMessages = [
            // 'username.required' => $lang == 'ar' ? "من فضلك أدخل أسمك" : "username is required",
            // 'username.unique' => $lang == 'ar' ? "تم استخدام اسم المستخدم بالفعل." : "The username has already been taken.",
            // 'phone.required' => $lang == 'ar' ? 'من فضك ادخل رقم الهاتف' :"phone is required"  ,
            'phone.unique' => $lang == 'ar' ? 'رقم الهاتف موجود لدينا بالفعل' :"phone is already teken" ,
            'phone.min' => $lang == 'ar' ?  'رقم الهاتف يجب ان لا يقل عن 7 ارقام' :"The phone must be at least 7 numbers" ,
            'phone.numeric' => $lang == 'ar' ?  ' الهاتف يجب ان يكون رقما' :"The phone must be a number" ,
            'phone.regex' => $lang == 'ar' ?  ' يجب أن يبدأ الهاتف ب صفر' :"The phone must start with 0" ,
            'password.min' => $lang == 'ar' ?  'كلمة السر يجب ان لا تقل عن 6 احرف' :"The password must be at least 6 character" ,       
            // 'email.required' => $lang == 'ar' ? 'من فضلك ادخل البريد الالكتروني' :"email is required"  ,
            'email.unique' => $lang == 'ar' ? 'هذا البريد الالكتروني موجود لدينا بالفعل' :"email is already token" ,
            'email.regex'=> $lang == 'ar'? 'من فضلك ادخل بريد الكتروني صالح' : 'The email must be a valid email address',
        ];
        $validator = Validator::make($input, [
            // 'username' => 'required|unique:users',
            'phone' => 'unique:users|numeric|min:7',/* |regex:/(0)[0-9]{9}/ */
            'password' => 'required|confirmed|min:6',
            //'city_id' => 'required',
            //'area_id' => 'required',
            'email' => 'unique:users|regex:/(.+)@(.+)\.(.+)/i',

        ], $validationMessages);

        if ($validator->fails()) {
            return $this->sendError($validator->messages()->first());
        }
        
        $add = new User;
        $add->username = $request->username;
        $add->email = $request->email;
        $add->phone = $request->phone;
        $add->password = bcrypt($request->password);

        $add->save();

        $token = JWTAuth::fromUser($add);

        $user = User::where('id' , $add->id)->first();
        $user['userToken'] = $token;
        $user['lang'] = $lang;
        return $this->sendResponse(UserResource::make($user) , "user data");
    }

    public function app_login (Request $request){

        $lang = $request->header('lang');
        $user = User::where([['phone',$request->phone] ])
                    ->orwhere([['email' , $request->phone] ])->first();
        if(is_null($user))
        {
            $msg = $lang=='ar' ?  'البيانات المدخلة غير موجودة لدينا ':'user not exist' ;
            return $this->sendError($msg);
        }
        $password = Hash::check($request->password,$user->password);
        if($password==true){

            if($request->firebase_token) {
                $user->firebase_token = $request->firebase_token;
            }
            $user->save();
            $token = JWTAuth::fromUser($user);
            $user['userToken'] = $token;
            $user['lang'] = $lang;


            $msg = $lang=='ar' ? 'تم تسجيل الدخول بنجاح':'Welcome, you are login successfull' ;

            return $this->sendSuccess($msg, 200, UserResource::make($user));
        }
        $msg = $lang=='ar' ?  'كلمة السر غير صحيحة' : 'Password is not correct' ;
        return $this->sendError($msg);
    }


    public function show_user_ByID(Request $request){
        $lang  = $request->header('lang');
        if(auth()->User()){
            $msg = $lang == 'ar' ? "بيانات المستخدم" : "user data";

            if( $request->has('user_id')){
               
                $data = User::where('id' , $request->user_id)->first();
                $data['lang'] = $lang;
                return $this->sendResponse(  UserResource::make($data) , "user data");
    
            }

            $data = User::where('id' , auth()->User()->id)->first();
            $data['lang'] = $lang;
            return $this->sendResponse(  UserResource::make($data) , "user data");

        }else{
            $msg = $lang == 'ar' ? " من فضلك سجل دخول" : "Token is not provided";

            return $this->sendError($msg);
        }
        
    }


    
    public function change_password(Request $request){

        $lang = $request->header('lang');
        $input = $request->all();
        $validationMessages = [
            'password.min' => $lang == 'ar' ?  'كلمة السر يجب ان لا تقل عن 6 احرف' :"The password must be at least 6 character" ,        ];

        $validator = Validator::make($input, [
            'password' => 'required|confirmed|min:6'
        ], $validationMessages);

        if ($validator->fails()) {
            return $this->sendError($validator->messages()->first());
        }
        $updatepass = User::where('phone' , $request->phone)->update(['password' =>  bcrypt($request->password)]);
        $msg = $lang == 'ar' ? "تم تعديل كلمه السر بنجاح" : "PAssword is changed successfuly";
        return $this->sendSuccess($msg);

    }
    
    public function update_profile(Request $request){
        $lang = $request->header('lang');

        if(auth()->User()){
            $created_at = carbon::now()->toDateTimeString();
            $dateTime = date('Y-m-d H:i:s',strtotime('+2 hours',strtotime($created_at)));

            $data = User::where('id' , auth()->User()->id)->first();
            
            $username = $request->has('username') && $request->username != NULL ? $request->username : $data->username;
            $email = $request->has('email') && $request->email != NULL ? $request->email : $data->email;
            $phone = $request->has('phone') && $request->phone != NULL ? $request->phone : $data->phone;
            $newpassword = $request->has('password') && $request->password != NULL ? bcrypt($request->password) : $data->password;

            $updateLocation = User::where('id' , auth()->User()->id)->update([
                "username" => $username,
                "email" => $email,
                "phone" => $phone,
                "password" =>$newpassword,
                "updated_at" => $dateTime     
            ]);

            $msg = $lang == 'ar' ? " تم تغير بياناتك بنجاح" : "profile is updated";

            return $this->sendResponse(UserResource::make(User::where('id' , auth()->User()->id)->first()) , $msg);
                                                            
                                                                        
        }else{
            $msg = $lang == 'ar' ? " من فضلك سجل دخول" : "Token is not provided";

            return $this->sendError($msg);
        }
    }
    

    public function update_CityArea(Request $request){
        $lang = $request->header('lang');

        if(auth()->User()){
            $created_at = carbon::now()->toDateTimeString();
            $dateTime = date('Y-m-d H:i:s',strtotime('+2 hours',strtotime($created_at)));

            $data = User::where('id' , auth()->User()->id)->first();
            
            $city_id = $request->has('city_id') ? $request->city_id : $data->city_id;
            $area_id = $request->has('area_id') ? $request->area_id : $data->area_id;

            $updateLocation = User::where('id' , auth()->User()->id)->update([
                                                                           "city_id" => $city_id,
                                                                           "area_id" => $area_id,
                                                                           "updated_at" => $dateTime     
                                                                        ]);

            $msg = $lang == 'ar' ? " تم تغير مكانك بنجاح" : "Location is updated";
            
            if($request->header('src') == 'web')
            return $this->sendResponse(UserResource::make(User::where('id' , auth()->User()->id)->first()) , $msg);
            return $this->sendSuccess($msg);
                                                            
                                                                        
        }else{
            $msg = $lang == 'ar' ? " من فضلك سجل دخول" : "Token is not provided";

            return $this->sendError($msg);
        }
    }


    public function Auth_logout(Request $request){
        $lang = $request->header('lang');

        if(auth()->User()){
        
            $delete_token  = User::where('id' , auth()->User()->id)->update(['firebase_token' => NULL]);

            auth()->logout() ;
            $msg = $lang == 'ar' ? " تم تسجيل الخروج بنجاح" : "Logout successfully";

            return $this->sendSuccess($msg);

        }else{

             $msg = $lang == 'ar' ? " من فضلك سجل دخول" : "Token is not provided";

            return $this->sendError($msg);
        }
    }
    
    
    

    //**************login with facebook and gmail ********/


    public function social_login(Request $request){

        $lang = $request->header('lang');
        $phone = $request->phone;


         if( $phone == NULL){
            $msg = $lang=='ar' ?  'البيانات المدخلة غير موجودة لدينا ':'user not exist' ;
            return $this->sendError($msg);

        }  
        
        $check_phone = User::where('phone' , $phone)->first();
        $check_email = User::where('email' , $phone)->first();

      
        if( $check_phone != NULL){
            $msg = $lang=='ar' ? 'تم تسجيل الدخول بنجاح':'Welcome, you are login successfull' ;

            $token = JWTAuth::fromUser($check_phone);
            $check_phone['userToken'] = $token;

            return response()->json([ 'error'=> 0,'message'=> $msg, 'data'=> UserResource::make($check_phone)]);

        }elseif($check_email != NULL){
            $msg = $lang=='ar' ? 'تم تسجيل الدخول بنجاح':'Welcome, you are login successfull' ;

            $token = JWTAuth::fromUser($check_email);
            $check_email['userToken'] = $token;

            return response()->json([ 'error'=> 0,'message'=> $msg, 'data'=> UserResource::make($check_email)]);
        }else{
            $msg = $lang=='ar' ?  'البيانات المدخلة غير موجودة لدينا ':'user not exist' ;
            return $this->sendError($msg);
        }
        
    }
    
}
