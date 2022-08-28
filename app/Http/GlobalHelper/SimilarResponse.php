<?php

namespace App\Http\GlobalHelper;

trait SimilarResponse {

    public static function next($responseMessage, $responseData = null, $code = 201){
        $data = [
            'status' => true,
            'message' => $responseMessage,
            'data' => $responseData ? $responseData : new \stdClass
        ];

        return response()->json($data, $code);
    }

    public static function denie($denieMessage, $denieData = null, $code = 400){
        $data = [
            'status' => false,
            'message' => $denieMessage,
            'data' => $denieData ? $denieData : new \stdClass
        ];

        return response()->json($data, $code);
    }

}