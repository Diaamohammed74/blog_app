<?php

namespace App\Http\Traits;


trait ApiResponse
{
    public static function apiResponse($data, $message = null, $status = 200)
    {
        $message = $message ? __($message) : ('Successful query');
        return response()->json([
            'message' => $message,
            'data'    => !empty($data) ? $data : [],
            'status'  => in_array($status, [200, 201, 202, 203]),
            'code'    => $status,
        ], $status);
    }

    public static function apiResponseStored($data)
    {
        return self::apiResponse($data, 'http-statuses.201', 201);
    }

    public static function apiResponseShow($data)
    {
        return self::apiResponse($data, 'main.success_query', 200);
    }

    public static function apiResponseUpdated($data)
    {
        return self::apiResponse($data, 'main.updated', 200);
    }
    public static function apiResponseDeleted()
    {
        return self::apiResponse([], 'main.deleted', 200);
    }
}
