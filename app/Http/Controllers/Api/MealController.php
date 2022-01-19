<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\UpdateMealRequest;
use App\Http\Requests\Api\StoreMealRequest;
use App\Http\Resources\Api\MealResource;
use App\Models\Meal;
use Illuminate\Http\JsonResponse;
use App\Services\MealService;
use Illuminate\Http\Response;

class MealController extends ApiController
{
    /**
     * @var MealService
     */
    private MealService $mealService;

    /**
     * @param MealService $mealService
     */
    public function __construct(MealService $mealService)
    {
        $this->mealService = $mealService;
    }

    /**
     * @return JsonResponse
     */
    public function index()
    {
        $meals = Meal::all();
        return $this->responseWithSuccess('Meals have been found', Response::HTTP_OK, MealResource::collection($meals));
    }

    /**
     * @param StoreMealRequest $request
     * @return JsonResponse
     */
    public function store(StoreMealRequest $request): JsonResponse
    {
        $meal = $this->mealService->create($request);
        return $this->responseWithSuccess('Meal has been created correctly', Response::HTTP_CREATED, MealResource::make($meal));
    }

    public function show($mealUuid)
    {
        $meal = Meal::where('uuid', $mealUuid)->first();
        return $this->responseWithSuccess('Meal has been found', Response::HTTP_OK, MealResource::make($meal));
    }

    /**
     * @param UpdateMealRequest $request
     * @param $mealUuid
     * @return JsonResponse
     */
    public function update(UpdateMealRequest $request, $mealUuid): JsonResponse
    {
        $mealUpdatedCorrectly = $this->mealService->update($request, $mealUuid);

        if(!$mealUpdatedCorrectly) {
            return $this->responseWithError('Something went wrong', Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $this->responseWithSuccess('Meal has been updated correctly', Response::HTTP_OK);
    }

    /**
     * @param string $mealUuid
     * @return JsonResponse
     */
    public function destroy(string $mealUuid): JsonResponse
    {
        $this->mealService->destroy($mealUuid);
        return $this->responseWithSuccess('Meal has been deleted', Response::HTTP_OK);
    }
}
