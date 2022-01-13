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
        Role::create(['name' => 'restaurant_owner']);
        $userRole = Role::create(['name' => 'user']);

        $user = User::create([
            'email' => 'test@test.com',
            'phone' => '123456789',
            'password' => PasswordHandler::generatePassword('1234test')
        ]);

        $user->assignRole($userRole);
    }
}
