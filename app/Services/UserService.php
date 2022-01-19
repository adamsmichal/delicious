<?php

namespace App\Services;

use App\Http\Requests\Api\UpdateUserRequest;
use App\Http\Requests\Api\StoreUserRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserService
{
    /**
     * @param StoreUserRequest $request
     * @return mixed
     */
    public function create(StoreUserRequest $request)
    {
        return User::create($this->getCreateUserData($request));
    }

    /**
     * @param UpdateUserRequest $request
     * @param string $userUuid
     * @return bool
     */
    public function update(UpdateUserRequest $request, string $userUuid)
    {
        $user = User::where('uuid', $userUuid)->first();
        return $user->update($request->validated());
    }

    /**
     * @param string $userUuid
     */
    public function destroy(string $userUuid)
    {
        $user = User::where('uuid', $userUuid)->first();
        $user->delete();
    }

    /**
     * @param $uuid
     * @return mixed
     */
    public function getId($uuid): mixed
    {
        return User::where('uuid', $uuid)->value('id');
    }

    /**
     * @param $request
     * @return array
     */
    private function getCreateUserData($request)
    {
        return [
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password)
        ];
    }
}
