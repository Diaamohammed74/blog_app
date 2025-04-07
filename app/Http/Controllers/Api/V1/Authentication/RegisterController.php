<?php

namespace App\Http\Controllers\Api\V1\Authentication;
use App\Models\User;
use App\Http\Traits\MediaHandler;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{
    use MediaHandler;
    public function register(RegisterRequest $request)
    {
        $user = User::create($request->validated());
        Auth::login($user);
        $userData = new UserResource($user);
        return $this->apiResponse([
            'token'     => $user->createToken("user_token", ['*'], now()->addDays(30))->plainTextToken,
            'user_data' => $userData,
        ], __('main.registered_success'), 201);
    }

}
