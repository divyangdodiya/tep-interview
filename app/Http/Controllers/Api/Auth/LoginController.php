<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\UserLoginRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(UserLoginRequest $request): JsonResponse
    {
        try {
            $credentials = $request->only(['email', 'password']);
            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                $data['token'] = $user->createToken($request->email)->plainTextToken;
                $data['user'] = $user;
                return apiResponse(true, 'Logged in successfully', $data, 200);
            } else {
                return apiResponse(false, 'Invalid username or password', '', 200);
            }
        } catch (Exception $e) {
            return apiResponse(false, 'Something Went Wrong', $e->getMessage(), 500);
        }
    }

    public function logout()
    {
        try {
            $user = Auth::user();
            if ($user) {
                $user->currentAccessToken()->delete();
                return apiResponse(true, 'Logged out successfully', '', 204);
            }
        } catch (Exception $e) {
            return apiResponse(false, 'Something Went Wrong', $e->getMessage(), 500);
        }
    }
}
