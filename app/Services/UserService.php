<?php

namespace App\Services;

use App\Helpers\PasswordHandler;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;

class UserService {

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
     * @param User $user
     * @return bool
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        return $user->update($this->getUpdateUserData($request));
    }

    public function destroy(User $user)
    {
        $user->delete();
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
            'password' => PasswordHandler::generatePassword($request->password)
        ];
    }

    /**
     * @param $request
     * @return array
     */
    private function getUpdateUserData($request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ];
    }
}
