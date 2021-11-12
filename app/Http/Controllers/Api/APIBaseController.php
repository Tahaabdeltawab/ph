<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Response;

class APIBaseController extends Controller
{
    public function makeResponse($data, $message = '', $code = 200)
    {
        return [
            'success' => true,
            'data'    => (object) $data,
            'message' => $message,
            'code'    => $code,
        ];
    }

    public function makeError($message, $code = 404, $data = [])
    {
        $res = [
            'success' => false,
            'data'    => (object) $data,  
            'message' => $message,
            'code'    => $code,
        ];
        return $res;
    }

    public function makeSuccess($message, $code = 200, $data = [])
    {
        return [
            'success' => true,
            'data' => (object) $data,
            'message' => $message,
            'code'    => $code,
        ];
    }

    public function sendResponse($data, $message = '', $code = 200)
    {
        return Response::json($this->makeResponse($data, $message, $code));
    }

    public function sendError($message, $code = 404, $data = [])
    {
        return Response::json($this->makeError($message, $code, $data));
    }

    public function sendSuccess($message, $code = 200, $data = [])
    {
        return Response::json($this->makeSuccess($message, $code, $data), 200);
    }
}
