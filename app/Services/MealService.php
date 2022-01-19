<?php

namespace App\Services;

use App\Http\Requests\Api\UpdateMealRequest;
use App\Http\Requests\Api\StoreMealRequest;
use App\Models\Meal;

class MealService
{
    /**
     * @param StoreMealRequest $request
     * @return mixed
     */
    public function create(StoreMealRequest $request)
    {
        return Meal::create($this->getCreateData($request));
    }

    /**
     * @param UpdateMealRequest $request
     * @param $mealUuid
     * @return mixed
     */
    public function update(UpdateMealRequest $request, $mealUuid)
    {
        $meal = Meal::where('uuid', $mealUuid)->first();
        return $meal->update($request->validated());
    }

    /**
     * @param string $mealUuid
     */
    public function destroy(string $mealUuid)
    {
        $meal = Meal::where('uuid', $mealUuid)->first();
        $meal->delete();
    }

    /**
     * @param StoreMealRequest $request
     * @return array
     */
    private function getCreateData(StoreMealRequest $request)
    {
        return [
            'name' => $request->name,
            'restaurant_id' => (int)$request->restaurant_id,
            'photo' => $request->photo,
            'description' => $request->description,
            'preparation_time' => $request->preparation_time,
            'is_active' => $request->is_active
        ];
    }
}
