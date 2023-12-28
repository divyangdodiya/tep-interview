<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\UserRegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class RegisterController extends Controller
{
    public function register(UserRegisterRequest $request): JsonResponse
    {
        try {
            $insertData = $request->validated();
            $user= User::create($insertData);
            if ($user) {
                return apiResponse(true, 'Registration successful ! Please login now', $user, 200);
            } else {
                return apiResponse(false, 'Invalid Request ! Please try again later', $insertData, 200);
            }
        } catch (\Exception $e) {
            return apiResponse(false, 'Something Went Wrong', $e->getMessage(), 500);
        }
    }
}
