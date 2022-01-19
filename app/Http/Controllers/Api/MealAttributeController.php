<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\UpdateMealAttributeRequest;
use App\Http\Requests\Api\StoreMealAttributeRequest;
use App\Http\Resources\Api\MealAttributeResource;
use App\Services\MealAttributeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class MealAttributeController extends ApiController
{
    /**
     * @var MealAttributeService
     */
    private MealAttributeService $mealAttributeService;

    /**
     * @param MealAttributeService $mealAttributeService
     */
    public function __construct(MealAttributeService $mealAttributeService)
    {
        $this->mealAttributeService = $mealAttributeService;
    }

    /**
     * @param StoreMealAttributeRequest $request
     * @return JsonResponse
     */
    public function store(StoreMealAttributeRequest $request): JsonResponse
    {
        $order = $this->mealAttributeService->create($request);
        return $this->responseWithSuccess('Meal attribute has been created correctly', Response::HTTP_CREATED, MealAttributeResource::make($order));
    }

    /**
     * @param UpdateMealAttributeRequest $request
     * @param $mealAttributeUuid
     * @return JsonResponse
     */
    public function update(UpdateMealAttributeRequest $request, $mealAttributeUuid): JsonResponse
    {
        $orderUpdatedCorrectly = $this->mealAttributeService->update($request, $mealAttributeUuid);

        if(!$orderUpdatedCorrectly) {
            return $this->responseWithError('Something went wrong', Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $this->responseWithSuccess('Meal attribute has been updated correctly', Response::HTTP_OK);
    }

    /**
     * @param string $mealAttributeUuid
     * @return JsonResponse
     */
    public function destroy(string $mealAttributeUuid): JsonResponse
    {
        $this->mealAttributeService->destroy($mealAttributeUuid);
        return $this->responseWithSuccess('Meal attribute has been deleted', Response::HTTP_OK);
    }
}
