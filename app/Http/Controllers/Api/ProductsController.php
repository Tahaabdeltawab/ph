<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ProductsResource;
use App\Models\Place_product;
use App\Http\Controllers\Manage\BaseController;
use Validator,Auth,Artisan,Hash,File,Crypt;
use carbon\Carbon;

class ProductsController extends Controller
{
    use ApiResponseTrait;

    public function update_product(Request $request){
        $lang = $request->header('lang');
        if(auth()->User()){
            $created_at = carbon::now()->toDateTimeString();
            $dateTime = date('Y-m-d H:i:s',strtotime('+2 hours',strtotime($created_at)));

            $product_id = $request->product_id;

            $product = Place_product::where('id' , $product_id)->first();

            $check = $this->not_found($product , 'المنتج', 'product' , $lang);
            if( isset($check) ){
                return $check;
            }

            $name_en = $request->has('name_en') ? $request->name_en : $product->name_en;
            $name_ar = $request->has('name_ar') ? $request->name_ar : $product->name_ar;
            $description_en = $request->has('description_en') ? $request->description_en : $product->description_en;
            $description_ar = $request->has('description_ar') ? $request->description_ar : $product->description_ar;
            $image = $request->has('image') && $request->image != NULL ? BaseController::saveImage("products" , $request->file('image')) : $product->image;
            $price = $request->has('price') ? $request->price : $product->price;
            
            $updateProduct = Place_product::where('id' , $product_id)->update([
                                                                        "name_en" => $name_en,
                                                                        "name_ar" => $name_ar,
                                                                        "image" => $image,
                                                                        "description_en" => $description_en,
                                                                        "description_ar" => $description_ar,
                                                                        "price" => $price,
                                                                        "updated_at" => $dateTime,
                                                                        ]);

            $msg = $lang == 'ar' ? " تم تعديل بيانات المنتج بنجاح" : "Product data is updated successfuly";

            return $this->apiResponseMessage( 0, $msg);
                                                            

        }else{
            $msg = $lang == 'ar' ? " من فضلك سجل دخول" : "Token is not provided";

            return $this->apiResponseMessage( 3, $msg);
        }
    }


    public function add_product(Request $request){
        $lang = $request->header('lang');
        if(auth()->User()){
            
            $input = $request->all();
            $validationMessages = [
                'name_ar.required' => $lang == 'ar' ?  'من فضلك ادخل اسم المنتج باللغه العربية' :"please enter product name in arabic" ,        
                'name_en.required' => $lang == 'ar' ?  'من فضلك ادخل اسم المنتج باللغه الانحليزية' :"please enter product name in english" ,      
                'description_ar.required' => $lang == 'ar' ?  'من فضلك ادخل وصف المنتج باللغه العربية' :"please enter product description in arabic" ,        
                'description_en.required' => $lang == 'ar' ?  'من فضلك ادخل وصف المنتج باللغه الانحليزية' :"please enter product description in english" ,      
                'price.required' => $lang == 'ar' ?  'من فضلك ادخل سعر المنتج' :"please enter product price" ,      
            
            ];

            $validator = Validator::make($input, [
                'name_ar' => 'required',
                'name_en' => 'required',
                'description_ar' => 'required',
                'description_en' => 'required',
                'price' => 'required',

            ], $validationMessages);

            if ($validator->fails()) {
                return $this->apiResponseMessage(1,$validator->messages()->first(), 200);
            }

            $created_at = carbon::now()->toDateTimeString();
            $dateTime = date('Y-m-d H:i:s',strtotime('+2 hours',strtotime($created_at)));

            $add = new  Place_product;
            $add->name_en = $request->name_en;
            $add->name_ar = $request->name_ar;
            $add->image = $request->file('image') ? BaseController::saveImage("products" , $request->file('image')) : NULL;
            $add->description_en = $request->description_en;
            $add->description_ar = $request->description_ar;
            $add->price = $request->price;
            $add->place_id = $request->place_id;
            $add->created_at = $dateTime;
            $add->updated_at = $dateTime;
            $add->save();

            $msg = $lang == 'ar' ? " تم أضافه المنتج بنجاح" : "Product is add successfully";
            if($request->header('src') == 'web')
            return $this->apiResponseData( new ProductsResource($add), $msg);
            return $this->apiResponseMessage( 0, $msg);

        }else{
            $msg = $lang == 'ar' ? " من فضلك سجل دخول" : "Token is not provided";

            return $this->apiResponseMessage( 3, $msg);
        }
    }



    public function delete_product(Request $request){
        $lang = $request->header('lang');

        if(auth()->User()){

            $product_id = $request->product_id;

            $product = Place_product::where('id' , $product_id)->first();

            $check = $this->not_found($product , 'المنتج', 'product' , $lang);
            if( isset($check) ){
                return $check;
            }
            
            $delete_product = Place_product::where('id' , $product_id)->delete();

            $msg = $lang == 'ar' ? " تم مسح هذا المنتج بنجاح" : "Product is deleted successfully";

            return $this->apiResponseMessage( 0, $msg);

        }else{
            $msg = $lang == 'ar' ? " من فضلك سجل دخول" : "Token is not provided";

            return $this->apiResponseMessage( 3, $msg);
        }
    }
}
