<?php

namespace App\Services;

use App\Http\Requests\Api\UpdateMealAttributeRequest;
use App\Http\Requests\Api\StoreMealAttributeRequest;
use App\Models\MealAttribute;

class MealAttributeService
{
    /**
     * @param StoreMealAttributeRequest $request
     * @return mixed
     */
    public function create(StoreMealAttributeRequest $request)
    {
        return MealAttribute::create($this->getCreateData($request));
    }

    /**
     * @param UpdateMealAttributeRequest $request
     * @param $mealAttributeUuid
     * @return mixed
     */
    public function update(UpdateMealAttributeRequest $request, $mealAttributeUuid)
    {
        $mealAttribute = MealAttribute::where('uuid', $mealAttributeUuid)->first();
        return $mealAttribute->update($request->validated());
    }

    /**
     * @param string $mealAttributeUuid
     */
    public function destroy(string $mealAttributeUuid)
    {
        $mealAttribute = MealAttribute::where('uuid', $mealAttributeUuid)->first();
        $mealAttribute->delete();
    }

    /**
     * @param StoreMealAttributeRequest $request
     * @return array
     */
    private function getCreateData(StoreMealAttributeRequest $request)
    {
        return [
            'meal_id' => $request->name,
            'price' => $request->price,
            'size' => $request->size
        ];
    }
}
