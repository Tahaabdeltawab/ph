<?php

namespace App\Http\Controllers\AdminDash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Place;
use carbon\carbon;
use App\Models\Place_aboutUs;
use App\Models\Place_service;
use App\Models\Place_product;
use App\Models\Place_offer;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\City;
use App\Models\Area;
use App\Models\User;
use App\Http\Controllers\Manage\BaseController;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class PlacesController extends Controller
{

    public function show_placePage()
    {
        return view('Place.show');
    }


    public function show_place_data()
    {

        $data = Place::all();

        return view('Place.show', ['data' => $data]);
    }

    public function show_placeDetails(Request $request)
    {

        $aboutUs = Place_aboutUs::where('place_id', $request->place_id)->get();

        $services = Place_service::where('place_id',  $request->place_id)->get();

        $products = Place_product::where('place_id', $request->place_id)->get();

        $offers = Place_offer::where('place_id', $request->place_id)->get();

        return view('Place.place_details', [
            'aboutUs' => $aboutUs, 'services' => $services,
            'products' => $products,  'offers' => $offers,
        ]);
    }

    public function show_addPage()
    {
        $data = category::all();
        $city = City::all();
        $users = User::where('role', 2)->get();
        return view('Place.addNew', ['data' => $data, 'city' => $city, 'users' => $users]);
    }

    public function myformAjax($id)
    {
        echo json_encode(SubCategory::where("category_id", $id)->get());
    }

    public function AreaData_byCityId($id)
    {
        echo json_encode(Area::where("city_id", $id)->get());
    }

    public function add_place(Request $request)
    {

        $created_at = carbon::now()->toDateTimeString();
        $dateTime = date('Y-m-d H:i:s', strtotime('+2 hours', strtotime($created_at)));

        $add = new Place;
        $add->name_ar = $request->name_ar;
        $add->name_en = $request->name_en;
        $add->image = $request->file('image') ? BaseController::saveImage("places", $request->file('image')) : NULL;
        $add->description_en = $request->description_en;
        $add->description_ar = $request->description_ar;
        $add->phone = $request->phone;
        $add->subCategory_id  = $request->subCategory_id;
        $add->city_id = $request->city_id;
        $add->area_id = $request->area_id;
        $add->Facebook = $request->Facebook;
        $add->Twitter = $request->Twitter;
        $add->user_id = $request->user_id;
        $add->created_at = $dateTime;
        $add->updated_at = $dateTime;
        $add->save();

        if ($add == true) {
            echo "<script>alert('تم أضافه المكان بنجاح');"
                . "window.location.replace('places')"
                . "</script>";
        } else {
            echo "<script>alert('يوجد خطأ حاول مره أخرى');"
                . "window.location.replace('places')"
                . "</script>";
        }
    }

    public function add_place_and_user()
    {
        $data = category::all();
        $city = City::all();
        $users = User::where('role', 2)->get();
        return view('Place.addNewPlaceAndUser', ['data' => $data, 'city' => $city, 'users' => $users]);
    }

    public function save_place_and_user(Request $request)
    {

        $created_at = carbon::now()->toDateTimeString();
        $dateTime = date('Y-m-d H:i:s', strtotime('+2 hours', strtotime($created_at)));

        $lang = $request->header('lang');
        $input = $request->all();


        if($request->user_type == 'new'){
            $validation_user = [
                'username' => 'required|unique:users',
                'phone_user' => 'unique:users,phone|numeric|min:7|regex:/(0)[0-9]{9}/',
                'email' => 'unique:users|regex:/(.+)@(.+)\.(.+)/i',
                'password' => 'required|confirmed|min:6',
                'city_id_user' => 'required|exists:city,id',
                'area_id_user' => 'required|exists:area,id',
            ];
        }elseif($request->user_type == 'present'){
            $validation_user = [
                'user_id' => 'required|exists:users,id',
            ];
        }else{
            return redirect()->back()->withInput()->with('error', 'نوع مستخدم غير صحيح');
        }

        $validation_place = [
            'city_id_place' => 'required|exists:city,id',
            'phone_place' => 'unique:places,phone|numeric|min:7|regex:/(0)[0-9]{9}/',
            'area_id_place' => 'required|exists:area,id',
            'subCategory_id' => 'required|exists:subcategory,id',
            'name_ar' => 'required|string',
            'name_en' => 'required|string',
        ];

        $validator = Validator::make($input, array_merge($validation_place, $validation_user));

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        // dd($request->all());


        try {
            DB::beginTransaction();
            if($request->user_type == 'new'){
            $add_user = new User();
            $add_user->username = $request->username;
            $add_user->email = $request->email;
            $add_user->phone = $request->phone_user;
            $add_user->password = bcrypt($request->password);
            $add_user->city_id  = $request->city_id_user;
            $add_user->area_id  = $request->area_id_user;
            $add_user->created_at = $dateTime;
            $add_user->updated_at = $dateTime;
            $add_user->save();

            // $token = JWTAuth::fromUser($add_user);

            $add_setting = new Setting();
            $add_setting->language = "en";
            $add_setting->notification = "on";
            $add_setting->user_id = $add_user->id;
            $add_setting->save();
            }
            $add_place = new Place();
            $add_place->name_ar = $request->name_ar;
            $add_place->name_en = $request->name_en;
            $add_place->image = $request->file('image') ? BaseController::saveImage("places", $request->file('image')) : NULL;
            $add_place->description_en = $request->description_en;
            $add_place->description_ar = $request->description_ar;
            $add_place->phone = $request->phone_place;
            $add_place->subCategory_id  = $request->subCategory_id;
            $add_place->city_id = $request->city_id_place;
            $add_place->area_id = $request->area_id_place;
            $add_place->Facebook = $request->Facebook;
            $add_place->Twitter = $request->Twitter;
            $add_place->user_id = $request->user_type == 'new' ? $add_user->id : $request->user_id ;
            $add_place->supervisor_id = auth()->id();
            $add_place->created_at = $dateTime;
            $add_place->updated_at = $dateTime;
            $add_place->save();

            DB::commit();

            return back()->with('success', __('success'));
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function destroy($id)
    {
        $place = Place::find($id);
        $place->aboutuses()->delete();
        $place->services()->delete();
        $place->products()->delete();
        $place->offers()->delete();
        $place->delete();
        return back()->with('success', __('success'));
    }

    public function updateStatus(Request $request)
    {
        try{
            $place = Place::find($request->place_id);
            $place->status = $request->status;
            $place->save();
            return response()->json(['success'=> '1']);
        }catch(\Throwable $th){
            return response()->json(['success'=> '0']);
        }
    }

}
