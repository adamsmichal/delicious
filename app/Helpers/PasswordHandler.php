<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Hash;
use App\Models\User;

class PasswordHandler
{
    /**
     * @param $password
     * @return string
     */
    static function generatePassword($password)
    {
        return Hash::make($password);
    }

    /**
     * @param User $user
     * @param $password
     * @return bool
     */
    static function checkPassword(User $user, $password)
    {
        return Hash::check($password, $user->password);
    }
}
