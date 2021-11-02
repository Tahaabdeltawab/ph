<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Manage\BaseController;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Place;
use App\Models\Place_service;
use App\Models\Place_product;
use App\Models\Place_offer;
use App\Models\Place_aboutUs;
use App\Http\Resources\PlaceResource;
use App\Http\Resources\ServicesResource;
use App\Http\Resources\ProductsResource;
use App\Http\Resources\OffersResource;
use App\Http\Resources\productAboutUSResource;
use App\Http\Resources\PlaceDataResources;
use carbon\carbon;

class PlaceController extends Controller
{
    use ApiResponseTrait;
    
    public function show_places_BySubcatId(Request $request){
        $lang = $request->header('lang');

        if(auth()->User()){
            $subcat_id = $request->subcat_id;

            $check_subcat = SubCategory::find($subcat_id);
            $check =  $this->not_found( $check_subcat, "القسم", "category" , $lang);
            
            if(isset($check)){
                return $check;
            }else{
                
                $places = Place::select('id', 'name_ar','name_en', 'image', 'description_ar','description_en', 'phone','Longitude', 'Latitude','Facebook','Twitter', 'user_id')->where('subCategory_id' ,$subcat_id)->get();
                $msg = $lang == 'ar' ? " الاماكن فى هذا القسم" : "places with this category";

                return $this->apiResponseData( PlaceResource::collection($places) , $msg);
            }
            
            
        }else{
            $msg = $lang == 'ar' ? " من فضلك سجل دخول" : "Token is not provided";

            return $this->apiResponseMessage( 3, $msg);
        }
    }


    public function show_place_details(Request $request){
        $lang = $request->header('lang');

        if(auth()->user()){
            $place_id = $request->place_id;


            $place =   Place::select('id', 'name_ar','name_en', 'image', 'description_ar','description_en', 'phone','Longitude', 'Latitude','Facebook','Twitter', 'user_id')->where('id' ,$place_id)->get();

            $services = Place_service::select('id' , 'details_ar', 'details_en')->where('place_id' , $place_id)->get();
        
            $products = Place_product::select('id' , 'name_ar','name_en' ,'image', 'description_ar', 'description_en' , 'price')->where('place_id' , $place_id)->get();

            $offers = Place_offer::select('id' , 'title_ar','title_en' , 'code' , 'present')->where('place_id' , $place_id)->get();

            $aboutus = Place_aboutUs::select('id' , 'details_ar', 'details_en')->where('place_id' , $place_id)->get();

           

            $all= [
                "place_details" => PlaceResource::collection($place)->first(),
                "place_services" => ServicesResource::collection($services),
                "products" => ProductsResource::collection($products),
                "offers" => OffersResource::collection($offers),
                "aboutUs" => productAboutUSResource::collection($aboutus),

            ];

            $msg = $lang == 'ar' ? " تفاصيل المكان" : "Place details";

            return $this->apiResponseData( $all , $msg);

        }else{
            $msg = $lang == 'ar' ? " من فضلك سجل دخول" : "Token is not provided";

            return $this->apiResponseMessage( 3, $msg);
        }
    }

    public function update_myPlace(Request $request){
        $lang = $request->has('lang');

        if(auth()->User()){
            $created_at = carbon::now()->toDateTimeString();
            $dateTime = date('Y-m-d H:i:s',strtotime('+2 hours',strtotime($created_at)));

            $place_id = $request->place_id;

            $place_data = Place::where('id' , $place_id)->first();

            $name_en = $request->has('name_en') && $request->name_en != NULL ? $request->name_en : $place_data->name_en;
            $name_ar = $request->has('name_ar') && $request->name_ar != NULL ? $request->name_ar : $place_data->name_ar;
            $description_en = $request->has('description_en') && $request->description_en != NULL ? $request->description_en : $place_data->description_en;
            $description_ar = $request->has('description_ar') && $request->description_ar != NULL ? $request->description_ar : $place_data->description_ar;
            $phone = $request->has('phone') && $request->phone != NULL ? $request->phone : $place_data->phone;
            $Facebook = $request->has('Facebook') && $request->Facebook != NULL ? $request->Facebook : $place_data->Facebook;
            $Twitter = $request->has('Twitter') && $request->Twitter != NULL ? $request->Twitter : $place_data->Twitter;
            $image = $request->has('image')
             && $request->image != NULL 
             ? BaseController::saveImage("places" , $request->file('image')) 
             : $place_data->image;

            $update_place = Place::where('id' , $place_id)->update([
                                                                "name_en" => $name_en,
                                                                "name_ar" => $name_ar,
                                                                "description_en" => $description_en,
                                                                "description_ar" => $description_ar,
                                                                "phone" => $phone,
                                                                "image" => $image,
                                                                "Facebook" => $Facebook,
                                                                "Twitter" => $Twitter,
                                                                "updated_at" => $dateTime,
                                                                ]);

            $msg = $lang == 'ar' ? " تم تعديل بيانات محلك بنجاح" : "Place data is updated";

            return $this->apiResponseMessage( 0, $msg);
        }else{
            $msg = $lang == 'ar' ? " من فضلك سجل دخول" : "Token is not provided";

            return $this->apiResponseMessage( 3, $msg);
        }
    }



    /******************all place data*******************/

    public function allCategory_places(Request $request){

        $all = array();

        $city_id = $request->city_id;
        $area_id = $request->area_id;

        $categorys = Category::all();

        foreach($categorys as $cat){
            $subcat = array();

            $subcategorys = SubCategory::where('category_id' , $cat->id)->get();

            foreach($subcategorys as $sub_cat){

                $places = Place::where([['city_id' , $city_id] , ['area_id' , $area_id ], ['subCategory_id' , $sub_cat->id]])->get();

                array_push($subcat , (object)array(
                    "subcat_id" => $sub_cat->id,
                    "subcat_name_en" => $sub_cat->name_en,
                    "subcat_name_ar" => $sub_cat->name_ar,
                    "subcat_image" => BaseController::getImageUrl("category" , $sub_cat->image),
                    "sub_image" => BaseController::getImageUrl("category" , $sub_cat->sub_image),
                    "places" => PlaceDataResources::collection($places),
                ));
            }

            array_push($all , (object)array(
                "category_id" => $cat->id,
                "category_name_ar" => $cat->name_ar,
                "category_name_en" => $cat->name_en,
                "subcategory" => $subcat,
            ));
        }

        return $this->apiResponseData( $all , "categories data");

    }
}
