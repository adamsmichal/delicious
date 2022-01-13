<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\Response;
use App\Models\User;

class UserController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function store(StoreUserRequest $request)
    {
        $user = $this->userService->create($request);

        return response()->json([
            'results' => UserResource::make($user),
            'message' => 'User has been created correctly',
            'error' => false
        ], Response::HTTP_CREATED);
    }

    public function update(UpdateUserRequest $request, string $userUuid)
    {
        $user = User::where('uuid', $userUuid)->first();
        $userUpdatedCorrectly = $this->userService->update($request, $user);

        if(!$userUpdatedCorrectly)
        {
            return response()->json([
                'message' => 'Something went wrong',
                'error' => true
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'results' => UserResource::make($user),
            'message' => 'User has been updated correctly',
            'error' => false
        ], Response::HTTP_OK);
    }
}
