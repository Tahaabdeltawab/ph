<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Favorite_place;
use carbon\carbon;
use App\Http\Resources\PlaceResource;

class FavoriteController extends Controller
{
    use ApiResponseTrait;

    public function add_favorite(Request $request){

        $lang = $request->header('lang');
        if(auth()->User()){

            $place_id = $request->place_id;

            $check_fav = Favorite_place::where([['place_id' , $place_id] , ['user_id' , auth()->User()->id]])->first();

            if($check_fav != NULL){
                $delete_fav = Favorite_place::where([['place_id' , $place_id] , ['user_id' , auth()->User()->id]])->delete();
           
                $msg = $lang == "ar" ? "تم مسح هذا  المكان من مفضلتك": "Place is deleted from your favorites";

            }else{
                $created_at = carbon::now()->toDateTimeString();
                $dateTime = date('Y-m-d H:i:s',strtotime('+2 hours',strtotime($created_at)));
    
                $add_fav = new Favorite_place;
                $add_fav->place_id = $place_id;
                $add_fav->user_id = auth()->User()->id;
                $add_fav->created_at = $dateTime;
                $add_fav->updated_at = $dateTime;
                $add_fav->save();

                $msg = $lang == "ar" ? "تم أضافه هذا المكان الى مفضلة": "Place is add to your favorites";

            }
            return $this->apiResponseMessage( 0, $msg);

        }else{
            $msg = $lang == 'ar' ? " من فضلك سجل دخول" : "Token is not provided";

            return $this->apiResponseMessage( 3, $msg);
        }
    }

    public function show_all_favorites(Request $request){
        $lang = $request->header('lang');

        if(auth()->User()){

            
            $get_favorites = Favorite_place::select('places.id', 'places.name_en','places.name_ar', 'places.image', 'places.description_en','places.description_ar', 
                                                    'places.phone','places.Longitude', 'places.Latitude','places.Facebook','places.Twitter')
                                            ->join('places' , 'favorite_places.place_id' ,'=' ,'places.id')
                                            ->where('favorite_places.user_id' , auth()->user()->id)->get();
        
            $msg = $lang == 'ar' ? " الاماكن المفضلة" : "Favorite places";

            return $this->apiResponseData( PlaceResource::collection($get_favorites) , $msg);
            
        }else{
            $msg = $lang == 'ar' ? " من فضلك سجل دخول" : "Token is not provided";

            return $this->apiResponseMessage( 3, $msg);
        }
    }
}
