<?php

namespace App\Observers;

use Illuminate\Support\Str;
use App\Models\Meal;

class MealObserver
{
    /**
     * Handle the Meal "created" event.
     *
     * @param Meal $meal
     * @return void
     */
    public function creating(Meal $meal)
    {
        $meal->uuid = Str::uuid();
    }

}
