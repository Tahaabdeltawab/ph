<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Http\Resources\SubCategoryResource;

class SubCategoryController extends Controller
{
    use ApiResponseTrait;

    public function show_all_subCategory(Request $request){
      
        $lang = $request->header('lang');
        if(auth()->User()){

            $category_id = $request->category_id;
            
            if( $request->has('category_id') && $category_id != 0){
                $subcategory = SubCategory::select('id' , 'name_ar', 'name_en' , 'image')
                                            ->where('category_id',  $category_id)->get();

                $msg = $lang == 'ar' ? " جميع الاقسام الفرعيه فى هذا القسم" : "All subcategory in this category";

                return $this->apiResponseData( SubCategoryResource::collection($subcategory) , $msg);
            
            }else{
                $subcategory = SubCategory::select('id' , 'name_ar', 'name_en' , 'image')->get();
            
                $msg = $lang == 'ar' ? " جميع الاقسام" : "All subcategory";

                return $this->apiResponseData( SubCategoryResource::collection($subcategory) , $msg);
            }
        }else{
            $msg = $lang == 'ar' ? " من فضلك سجل دخول" : "Token is not provided";

            return $this->apiResponseMessage( 3, $msg);
        }
    }
}
