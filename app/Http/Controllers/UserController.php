<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use App\Services\UserService;
use Illuminate\Http\Response;
use App\Models\User;

class UserController extends Controller
{
    /**
     * @var UserService
     */
    private UserService $userService;

    /**
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param StoreUserRequest $request
     * @return JsonResponse
     */
    public function store(StoreUserRequest $request): JsonResponse
    {
        $user = $this->userService->create($request);

        return response()->json([
            'results' => UserResource::make($user),
            'message' => 'User has been created correctly',
            'error' => false
        ], Response::HTTP_CREATED);
    }

    /**
     * @param string $userUuid
     * @return JsonResponse
     */
    public function show(string $userUuid): JsonResponse
    {
        $user = User::where('uuid', $userUuid)->first();

        return response()->json([
            'results' => UserResource::make($user),
            'message' => 'User has been found',
            'error' => false
        ], Response::HTTP_OK);
    }

    /**
     * @param UpdateUserRequest $request
     * @param string $userUuid
     * @return JsonResponse
     */
    public function update(UpdateUserRequest $request, string $userUuid)
    {
        $userUpdatedCorrectly = $this->userService->update($request, $userUuid);

        if(!$userUpdatedCorrectly)
        {
            return response()->json([
                'message' => 'Something went wrong',
                'error' => true
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'message' => 'User has been updated correctly',
            'error' => false
        ], Response::HTTP_OK);
    }

    /**
     * @param string $userUuid
     * @return JsonResponse
     */
    public function destroy(string $userUuid): JsonResponse
    {
        $this->userService->destroy($userUuid);

        return response()->json([
            'message' => 'User has been deleted correctly',
            'error' => false
        ], Response::HTTP_OK);
    }
}
