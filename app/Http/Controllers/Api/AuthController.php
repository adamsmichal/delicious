<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends ApiController
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $user = User::where('email', $request->email)->first();

        if(!$user || !Hash::check($user, $request->password))
        {
            return $this->responseWithError('Bad credentials', Response::HTTP_UNAUTHORIZED);
        }

        $token = $user->createToken('authToken')->plainTextToken;

        $data = [
            'token' => $token,
            'user' => $user
        ];
        return $this->responseWithSuccess('Correct credentials', Response::HTTP_OK, $data);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        $user = User::where('uuid', $request->uuid)->first();
        $user->tokens()->delete();

        return $this->responseWithSuccess('Logged out successfully', Response::HTTP_OK);
    }
}
