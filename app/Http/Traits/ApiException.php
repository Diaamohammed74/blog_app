<?php

namespace App\Http\Traits;

use Illuminate\Database\QueryException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class ApiException
{
    use ApiResponse;

    public static function apiException($e)
    {
        if ($e instanceof ValidationException) {
            $errors = $e->errors();
            return ApiResponse::apiResponse($errors, __('http-statuses.422'), 422);
        }
        if ($e instanceof NotFoundHttpException) {
            return ApiResponse::apiResponse(null, __('http-statuses.404'), 404);
        }
        if ($e instanceof ModelNotFoundException) {
            return ApiResponse::apiResponse(null, __('http-statuses.404'), 404);
        }
        if (config('app.env') == 'production') {
            if ($e instanceof QueryException) {
                return ApiResponse::apiResponse(null, __('http-statuses.500'), 500);
            }
        }
        if ($e instanceof AuthorizationException) {
            return ApiResponse::apiResponse(null, __('http-statuses.401'), 401);
        }
        if ($e instanceof AccessDeniedHttpException) {
            return ApiResponse::apiResponse(null, __('http-statuses.403'), 403);
        }
        if ($e instanceof AuthenticationException) {
            return ApiResponse::apiResponse(null, __('http-statuses.401'), 401);
        }
        if ($e instanceof HttpException && $e->getStatusCode() === 403) {
            return ApiResponse::apiResponse(null, __('main.not_verified'), 403);
        }
    }
}
