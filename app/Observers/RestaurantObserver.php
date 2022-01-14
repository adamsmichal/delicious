<?php

namespace App\Observers;

use Illuminate\Support\Str;
use App\Models\Restaurant;

class RestaurantObserver
{
    /**
     * Handle the Restaurant "created" event.
     *
     * @param Restaurant $restaurant
     * @return void
     */
    public function creating(Restaurant $restaurant)
    {
        $restaurant->uuid = Str::uuid();
    }

}
