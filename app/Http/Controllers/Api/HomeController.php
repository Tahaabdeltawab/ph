<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\SubCategory;
use App\Models\Place;
use App\Models\Category;
use App\Http\Resources\SliderResource;
use App\Http\Resources\SubCategoryResource;
use App\Http\Resources\PopularPlaceResource;

class HomeController extends Controller
{
    use ApiResponseTrait;

    public function Home(Request $request){
        $lang = $request->header('lang');
        $area_id = $request->area_id;
        $needs = explode(',', $request->needs);
        if($request->needs && array_intersect(['Slider', 'subcategory', 'popular_section', 'all_category'], $needs) ){
            if(in_array('Slider', $needs))
            $all["Slider"] = SliderResource::collection(Slider::all());
            
            if(in_array('all_category', $needs))
            $all["all_category"] = SubCategoryResource::collection(SubCategory::select('id' , 'name_ar', 'name_en' , 'image')->get());
            
            if(in_array('popular_section', $needs))
            $all["popular_section"] = PopularPlaceResource::collection(Place::select('id' , 'name_ar','name_en' , 'image')->when($area_id, function ($q) use($area_id){
                return $q->where('area_id' , $area_id);
            })->where('popular_section' , 1)->limit(6)->get());
            
            if(in_array('subcategory', $needs))
            $all["subcategory"] = SubCategoryResource::collection(SubCategory::all());
        }else{
            $all = [
                "Slider" => SliderResource::collection(Slider::all()),
    
                "all_category" => SubCategoryResource::collection(SubCategory::select('id' , 'name_ar', 'name_en' , 'image')->get()),
    
                "popular_section" => PopularPlaceResource::collection(Place::select('id' , 'name_ar','name_en' , 'image')->when($area_id, function ($q) use($area_id){
                    return $q->where('area_id' , $area_id);
                })->where('popular_section' , 1)->limit(6)->get()),
    
                "subcategory" => SubCategoryResource::collection(SubCategory::all()),
            ];
        }
        return $this->apiResponseData(  $all , "Home data");

    }
}
