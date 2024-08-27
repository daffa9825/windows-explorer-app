<?php
if (! function_exists('getResponseApi')) {
    function getResponseApi($status, $data, $message,)
    {
        $response = [
            'status' => $status,
            'data'    => $data,
            'message' => $message,
        ];
        return response()->json($response, 200);
    }
}
