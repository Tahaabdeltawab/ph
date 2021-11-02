<?php

namespace App\Http\Controllers\AdminDash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiResponseTrait;
use App\Models\User;
use App\Models\Place;
use App\Models\SubCategory;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    use ApiResponseTrait;


    public function user_page(){
        return view('users');
    }
    public function show_users(){
        $get_users = User::where('role', '2')->get();

        return view("users", ["get_users" => UserResource::collection($get_users)] );

    }

    public function delete_user(Request $request){

        $deleteUser = User::where('id' , $request->user_id)->delete();

        echo "<script>alert('تم مسح المستخدم بنجاح');"
                    . "window.location.replace('/users')"
                    . "</script>";
    }

    public function dash_data(){
        $users = User::where('role' , 2)->count();
        $places = Place::count();
        $subcategory = SubCategory::count();
        $all = [
            "users" => $users,
            "places" => $places,
            "subcategory" => $subcategory,
        ];
        return view('home' ,['all' => $all]);
    }
}
