<?php

namespace App\Http\Controllers;

use App\Helpers\PasswordHandler;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if(!$user || !PasswordHandler::checkPassword($user, $request->password))
        {
            return response([
                'message' => 'Bad credentials',
                'error' => true
            ], Response::HTTP_UNAUTHORIZED);
        }

        $token = $user->createToken('authToken')->plainTextToken;

        return response([
            'token' => $token,
            'user' => $user,
            'message' => 'Correct credentials',
            'error' => false
        ], Response::HTTP_OK);
    }

    public function logout(Request $request)
    {
        $user = User::where('uuid', $request->uuid)->first();

        $user->tokens()->delete();

        return response([
            'message' => 'Logged out successfully',
            'error' => false
        ], Response::HTTP_OK);
    }
}
