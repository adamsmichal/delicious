<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class ApiController extends Controller
{
    protected function responseWithSuccess($message, $code, $data = null): JsonResponse
    {
        $response = [
            'status' => true,
            'message' => $message,
        ];

        if($data !== null){
            $response['data'] = $data;
        }

        return response()->json($response, $code);
    }

    protected function responseWithError($message, $code): JsonResponse
    {
        return response()->json([
            'status' => false,
            'message' => $message
        ], $code);
    }
}
