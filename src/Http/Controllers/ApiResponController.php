<?php

namespace Khantnyar\ScaffoldedLaravel\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiResponController extends Controller
{
    public function sendResponse($message, $data = null)
    {
        $response = [
            'success' => true,
            'message' => $message,
        ];

        if (!empty($data)) {
            $response['data'] = $data;
        }

        return response()->json($response, 200);
    }

    //send error api response
    public function sendError($status, $message, $data = null)
    {
        $response = [
            'success' => false,
            'message' => $message,
        ];
        if (!empty($data)) {
            $response['data'] = $data;
        }
        return response()->json($response, $status);
    }
}
