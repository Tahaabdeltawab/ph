<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator,Auth,Artisan,Hash,File,Crypt;
use App\Models\Notification;
use App\Models\user_notification;
define( 'API_ACCESS_KEY12', 'AAAAwMhS47g:APA91bGqo5zYMAsffvkHMsCVUwpo9-OwCh6NkWgky4UVZUTKe34vAZYFT1QxTcq5jLtnJtGpDkKwtoU1abgW8OlR_32C17XBj4F4tkonjDvijhyUasgOaFhhLXN93tK2zDLbXngGAZfo');

class BaseController extends Controller
{
    public  static function get_url(){
        return url('');
        // return 'http://app.madienty.com/';
    }

    public  static function getImageUrl($folder,$file){
        if($file)
            return BaseController::get_url() . '/uploads/'.$folder .'/'.$file;
        return BaseController::get_url() . '/uploads/Logo.png';

    }

    public static function saveImage($folder,$file)
    {
        $input['image'] = mt_rand(). time().'.'.$file->getClientOriginalExtension();
        $destinationPath_id = public_path('uploads/'.$folder.'/');
        $file->move($destinationPath_id, $input['image']);
        return $input['image'];

    }
    /*
     * TO Delete File From server storage
     */
    public static function deleteFile($folder,$file)
    {
        // $destinationPath_id = 'uploads/'.$folder.'/'.$file;
        $file = public_path('uploads/'.$folder.'/'.$file);
        if(file_exists($file))
        {
            File::delete($file);
        }
    }


       public static function send_notification($firebase_token , $title, $body, $notification_id ,$user_id){
        

                                 
             $msg = array
                  (
        		'body' 	=> $body,
        		'title'	=> $title,
                  );
        	$fields = array
        			(
        				'to'		=> $firebase_token,
        				'data'      => $msg,
        				'notification'	=> $msg
        			);

        	$headers = array
        			(
        				'Authorization: key=' . API_ACCESS_KEY12,
        				'Content-Type: application/json'
        			);
        #Send Reponse To FireBase Server	
        		$ch = curl_init();
        		curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        		curl_setopt( $ch,CURLOPT_POST, true );
        		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        		curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        		curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        		$result = curl_exec($ch );
        		//echo $result;
        		curl_close( $ch );
               

            $add =  new user_notification;
            $add->notification_id = $notification_id;
            $add->user_id = $user_id;
            $add->save();
    }



}
