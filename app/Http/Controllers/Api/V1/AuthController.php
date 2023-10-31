<?php

namespace App\Http\Controllers\Api\V1;

use App\Facades\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginUserRequest $request)
    {
        $credentials = $request->only('email', 'password');
        $data = [
            'access_token' => auth()->attempt($credentials),
        ];

        return ApiResponse::message(__('user.messages.user_successfuly_login'))
            ->data($data)
            ->send();
    }

    public function register(RegisterUserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return ApiResponse::message(__('payment.messages.user_successfuly_register'))
            ->data(new UserResource($user))
            ->send();
    }

    public function refresh()
    {
        $data = [
            'access_token' => auth()->refresh(),
        ];
        return ApiResponse::message(__('user.messages.user_token_successfuly_refresh'))
            ->data($data)
            ->send();
    }

    public function getMe()
    {
        return ApiResponse::message(__('user.messages.user_info'))
            ->data(new UserResource(auth()->user()))
            ->send();
    }

    public function logout()
    {
        auth()->logout();
        return ApiResponse::message(__('payment.messages.user_successfuly_logout'))
            ->send();
    }
}
