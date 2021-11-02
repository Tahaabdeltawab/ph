<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usage_agreement;
use App\Http\Resources\UsageAgreementResources;

class UsageAgreementController extends Controller
{
    use ApiResponseTrait;

    public function show_usageAgreement(Request $request){
        $lang = $request->header('lang');

        $data = Usage_agreement::all();
        $msg = $lang == "ar" ? "أتفاقيه الاستخدام" : "Usage agreement";

        return $this->apiResponseData(  UsageAgreementResources::collection($data) , $msg);
    }
}
