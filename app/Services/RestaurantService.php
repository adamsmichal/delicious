<?php

namespace App\Services;

use App\Http\Requests\UpdateRestaurantRequest;
use App\Http\Requests\StoreRestaurantRequest;
use App\Models\Restaurant;

class RestaurantService
{
    /**
     * @param StoreRestaurantRequest $request
     * @return mixed
     */
    public function create(StoreRestaurantRequest $request): mixed
    {
        return Restaurant::create($this->getCreateRestaurantData($request));
    }

    /**
     * @param UpdateRestaurantRequest $request
     * @param string $restaurantUuid
     * @return bool
     */
    public function update(UpdateRestaurantRequest $request, string $restaurantUuid): bool
    {
        $restaurant = Restaurant::where('uuid', $restaurantUuid)->first();
        return $restaurant->update($request->validated());
    }

    /**
     * @param string $restaurantUuid
     */
    public function destroy(string $restaurantUuid)
    {
        $restaurant = Restaurant::where('uuid', $restaurantUuid)->first();
        $restaurant->delete();
    }

    /**
     * @param StoreRestaurantRequest $request
     * @return array
     */
    private function getCreateRestaurantData(StoreRestaurantRequest $request)
    {
        return [
            'name' => $request->name,
            'tax_number' => $request->tax_number
        ];
    }
}
