<?php
namespace App\Exceptions;

use Throwable;
use App\Http\Traits\ApiException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
class Handler extends ExceptionHandler
{

    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register(): void
    {
        $this->renderable(function(Throwable $e){
            return ApiException::apiException($e);
        });
    }
}