<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;
use App\Models\User;

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
            'password' => Hash::make('1234test'),
            'restaurant_id' => 1,
            'address_id' => 2
        ]);

        $user = User::create([
            'email' => 'testUser@test.com',
            'phone' => '987654321',
            'password' => Hash::make('1234test'),
            'restaurant_id' => null
        ]);

        $restaurantAccount->assignRole($restaurantAccountRole);
        $user->assignRole($userRole);
    }
}
