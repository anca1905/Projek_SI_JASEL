<?php

namespace App\Helpers;

class ResponseHelper
{
    public static function success($data = null, $message = 'Success')
    {
        return response()->json([
            'status'  => true,
            'message' => $message,
            'data'    => $data
        ], 200);
    }

    public static function error($message = 'Error', $code = 500, $errors = null)
    {
        return response()->json([
            'status'  => false,
            'message' => $message,
            'errors'  => $errors
        ], $code);
    }
}
