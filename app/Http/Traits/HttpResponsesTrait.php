<?php

namespace App\Http\Traits;

trait HttpResponsesTrait
{
    private function success($data, $message = null, $code = 200){
        return response()->json([
            'status' => 'Request was successful',
            'message' => $message,
            'data' => $data
        ],$code);
    }

    private function error($data, $message = null, $code){
        return response()->json([
            'status' => 'Error has occurred',
            'message' => $message,
            'data' => $data
        ],$code);
    }
}