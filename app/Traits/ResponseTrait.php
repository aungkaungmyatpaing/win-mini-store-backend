<?php

namespace App\Traits;

trait ResponseTrait
{
    public function successResponse($data)
    {
        return response()->json([
            'status' => true,
            'data' => $data
        ], 200);
    }

    public function errorResponse($error, $code = 500)
    {
        return response()->json([
            'status' => false,
            'error' => $error
        ], $code);
    }
}