<?php

namespace Database\Seeders;

use App\Helpers\PasswordHandler;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $restaurantAccountRole = Role::create(['name' => 'restaurant_account']);
        $userRole = Role::create(['name' => 'user']);

        $restaurantAccount = User::create([
            'email' => 'testAccount@test.com',
            'phone' => '123456789',
            'password' => PasswordHandler::generatePassword('1234test'),
            'restaurant_id' => 1
        ]);

        $user = User::create([
            'email' => 'testUser@test.com',
            'phone' => '987654321',
            'password' => PasswordHandler::generatePassword('1234test'),
            'restaurant_id' => null
        ]);

        $restaurantAccount->assignRole($restaurantAccountRole);
        $user->assignRole($userRole);
    }
}
