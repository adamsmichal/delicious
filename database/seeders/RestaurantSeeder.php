<?php

namespace Database\Seeders;

use App\Helpers\PasswordHandler;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Restaurant::create([
            'name' => 'TestPub',
            'tax_number' => '404404'
        ]);
    }
}
