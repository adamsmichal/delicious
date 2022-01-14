<?php

namespace App\Services;

use App\Http\Requests\UpdateRestaurantRequest;
use App\Http\Requests\StoreRestaurantRequest;
use App\Models\Restaurant;

class RestaurantService {
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
     * @param Restaurant $restaurant
     * @return bool
     */
    public function update(UpdateRestaurantRequest $request, Restaurant $restaurant): bool
    {
        return $restaurant->update($request->validated());
    }

    /**
     * @param Restaurant $restaurant
     */
    public function destroy(Restaurant $restaurant)
    {
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
