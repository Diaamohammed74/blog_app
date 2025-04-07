<?php

namespace App\Http\Controllers\Api\V1\Authentication;

use App\Http\Traits\MediaHandler;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    use MediaHandler;
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();
        
        if (!Auth::attempt($credentials)) {
            return $this->apiResponse([], __('main.credentials_failed'), 401);
        }
        
        $user     = Auth::user();
        $userData = new UserResource($user);
        
        $user->tokens()->delete();
        
        return $this->apiResponse([
            'token'     => $user->createToken("user_token", ['*'], now()->addDays(30))->plainTextToken,
            'user_data' => $userData,
        ], __('main.login_success'), 200);
    }
    
    public function logout()
    {
        Auth::user()->currentAccessToken()->delete();
        return $this->apiResponse([], __('main.loggedout'), 200);
    }

}
