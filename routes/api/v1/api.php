<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Authentication\LoginController;
use App\Http\Controllers\Api\V1\Authentication\RegisterController;

Route::prefix('auth')->group(function () {
    Route::post('/register', [RegisterController::class, 'register']);
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');
});

Route::apiResource('/posts', \App\Http\Controllers\Api\V1\Post\PostController::class)
->except(['index','show'])
->middleware('auth:sanctum');

Route::prefix('posts')->controller(\App\Http\Controllers\Api\V1\Post\PostController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/{post}', 'show');
});
