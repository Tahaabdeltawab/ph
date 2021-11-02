<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Privacy_policy;
use App\Http\Resources\PolicyPrivacyResources;

class PrivacyPolicyController extends Controller
{
    use ApiResponseTrait;

    public function show_privacyPolicy(Request $request){
        $lang = $request->header('lang');

        $data = Privacy_policy::all();
        $msg = $lang == "ar" ? "سياسه الخصوصيه" : "Privacy policy";

        return $this->apiResponseData(  PolicyPrivacyResources::collection($data) , $msg);

    }
}
