<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\UpdateUserRequest;
use App\Http\Requests\Api\StoreUserRequest;
use App\Http\Resources\Api\UserResource;
use Illuminate\Http\JsonResponse;
use App\Services\UserService;
use Illuminate\Http\Response;
use App\Models\User;

class UserController extends ApiController
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
        return $this->responseWithSuccess('User has been created correctly', Response::HTTP_CREATED, UserResource::make($user));
    }

    /**
     * @param string $userUuid
     * @return JsonResponse
     */
    public function show(string $userUuid): JsonResponse
    {
        $user = User::where('uuid', $userUuid)->first();
        return $this->responseWithSuccess('User has been found', Response::HTTP_OK, UserResource::make($user));
    }

    /**
     * @param UpdateUserRequest $request
     * @param string $userUuid
     * @return JsonResponse
     */
    public function update(UpdateUserRequest $request, string $userUuid): JsonResponse
    {
        $userUpdatedCorrectly = $this->userService->update($request, $userUuid);

        if(!$userUpdatedCorrectly)
        {
            return $this->responseWithError('Something went wrong', Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $this->responseWithSuccess('User has been updated correctly', Response::HTTP_OK);
    }

    /**
     * @param string $userUuid
     * @return JsonResponse
     */
    public function destroy(string $userUuid): JsonResponse
    {
        $this->userService->destroy($userUuid);
        return $this->responseWithSuccess('User has been deleted correctly', Response::HTTP_OK);
    }
}
