<?php

namespace App\Http\Controllers\Core;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class PublicCoreC extends Controller
{
    private $__tmp_res = [
        "status" => true,
        "message" => "",
    ];

    public function __construct()
    {
    }

    function successJsonResponse($data = null): JsonResponse
    {
        if (!empty($data)) {
            $this->__tmp_res["data"] = $data;
        }
        return response()->json($this->__tmp_res);
    }

    function errorJsonResponse($message = null, $stacktrace = null): JsonResponse
    {
        $this->__tmp_res["status"] = false;
        if (!empty($message)) {
            $this->__tmp_res["message"] = $message;
        }

        if (env("APP_DEBUG", false)) {
            $this->__tmp_res["stacktrace"] = $stacktrace;
        }

        return response()->json($this->__tmp_res);
    }
}
