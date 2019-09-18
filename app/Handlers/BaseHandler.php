<?php

namespace App\Handlers;

class BaseHandler
{
    public function returnArray($data = [], $message = "", $error = 0)
    {
        return [
            "error"   => $error,
            "data"    => $data,
            "message" => $message,
        ];
    }
}
