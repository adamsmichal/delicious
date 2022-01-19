<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\UpdateRestaurantRequest;
use App\Http\Requests\Api\StoreRestaurantRequest;
use App\Http\Resources\Api\RestaurantResource;
use App\Services\RestaurantService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use App\Models\Restaurant;

class RestaurantController extends ApiController
{
    /**
     * @var RestaurantService
     */
    private RestaurantService $restaurantService;

    /**
     * @param RestaurantService $restaurantService
     */
    public function __construct(RestaurantService $restaurantService)
    {
        $this->restaurantService = $restaurantService;
    }

    /**
     * @param StoreRestaurantRequest $request
     * @return JsonResponse
     */
    public function store(StoreRestaurantRequest $request): JsonResponse
    {
        $restaurant = $this->restaurantService->create($request);
        return $this->responseWithSuccess('Restaurant has been created correctly', Response::HTTP_CREATED, RestaurantResource::make($restaurant));
    }

    public function show($restaurantUuid): JsonResponse
    {
        $restaurant = Restaurant::where('uuid', $restaurantUuid)->first();
        return $this->responseWithSuccess('Restaurant has been found', Response::HTTP_OK, RestaurantResource::make($restaurant));
    }

    /**
     * @param UpdateRestaurantRequest $request
     * @param $restaurantUuid
     * @return JsonResponse
     */
    public function update(UpdateRestaurantRequest $request, $restaurantUuid): JsonResponse
    {
        $restaurantUpdatedCorrectly = $this->restaurantService->update($request, $restaurantUuid);

        if(!$restaurantUpdatedCorrectly) {
            return $this->responseWithError('Something went wrong', Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $this->responseWithSuccess('Restaurant has been updated correctly', Response::HTTP_OK);
    }

    /**
     * @param string $restaurantUuid
     * @return JsonResponse
     */
    public function destroy(string $restaurantUuid): JsonResponse
    {
        $this->restaurantService->destroy($restaurantUuid);
        return $this->responseWithSuccess('Restaurant has been deleted correctly', Response::HTTP_OK);
    }
}
