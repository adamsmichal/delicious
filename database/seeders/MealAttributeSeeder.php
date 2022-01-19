<?php

namespace Database\Seeders;

use App\Models\MealAttribute;
use Illuminate\Database\Seeder;

class MealAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MealAttribute::factory()->count(10)->create();
    }
}
