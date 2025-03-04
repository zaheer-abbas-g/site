<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;


class MessageResponse
{
    public  static function sendResponse($status, $result, $message, $code = 200)
    {
        return response()->json([
            'status' => $status,
            'result' => $result,
            "message" => $message
        ], $code);
    }

    public static function sendError($status, $message, $error, $code)
    {
        return response()->json([
            'status'  => $status,
            'message' => $message,
            'error'   => $error
        ], $code);
    }
}
