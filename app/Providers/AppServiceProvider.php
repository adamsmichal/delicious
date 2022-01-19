<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Observers\RestaurantObserver;
use App\Observers\AddressObserver;
use App\Observers\OrderObserver;
use App\Observers\MealObserver;
use App\Observers\UserObserver;
use App\Models\Restaurant;
use App\Models\Address;
use App\Models\Order;
use App\Models\Meal;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);
        Restaurant::observe(RestaurantObserver::class);
        Address::observe(AddressObserver::class);
        Order::observe(OrderObserver::class);
        Meal::observe(MealObserver::class);
    }
}
