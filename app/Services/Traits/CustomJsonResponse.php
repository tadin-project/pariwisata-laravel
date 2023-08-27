<?php

namespace App\Services\Traits;

trait CustomJsonResponse
{
    private $__tmp_res = [
        "status" => true,
        "message" => "",
    ];

    protected function successJsonResponse($data = null): array
    {
        if (!empty($data)) {
            $this->__tmp_res["data"] = $data;
        }
        return $this->__tmp_res;
    }

    protected function errorJsonResponse($message = null, $stacktrace = null): array
    {
        $this->__tmp_res["status"] = false;
        if (!empty($message)) {
            $this->__tmp_res["message"] = $message;
        }

        if (env("APP_DEBUG", false)) {
            $this->__tmp_res["stacktrace"] = $stacktrace;
        }

        return $this->__tmp_res;
    }
}
