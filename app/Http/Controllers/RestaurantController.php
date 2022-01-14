<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateRestaurantRequest;
use App\Http\Requests\StoreRestaurantRequest;
use App\Http\Resources\RestaurantResource;
use App\Services\RestaurantService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use App\Models\Restaurant;

class RestaurantController extends Controller
{
    /**
     * @var RestaurantService
     */
    protected RestaurantService $restaurantService;

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

        return response()->json([
            'results' => RestaurantResource::make($restaurant),
            'message' => 'Restaurant has been created correctly',
            'error' => false
        ], Response::HTTP_CREATED);
    }

    public function show($restaurantUuid)
    {
        $restaurant = Restaurant::where('uuid', $restaurantUuid)->first();

        return response()->json([
            'results' => RestaurantResource::make($restaurant),
            'message' => 'Restaurant has been found',
            'error' => false
        ], Response::HTTP_OK);
    }

    /**
     * @param UpdateRestaurantRequest $request
     * @param $restaurantUuid
     * @return JsonResponse
     */
    public function update(UpdateRestaurantRequest $request, $restaurantUuid): JsonResponse
    {
        $restaurant = Restaurant::where('uuid', $restaurantUuid)->first();
        $restaurantUpdatedCorrectly = $this->restaurantService->update($request, $restaurant);

        if(!$restaurantUpdatedCorrectly) {
            return response()->json([
                'message' => 'Something went wrong',
                'error' => true
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'message' => 'Restaurant has been updated correctly',
            'error' => false
        ], Response::HTTP_OK);
    }

    /**
     * @param $restaurantUuid
     * @return JsonResponse
     */
    public function destroy($restaurantUuid): JsonResponse
    {
        $user = Restaurant::where('uuid', $restaurantUuid)->first();
        $this->restaurantService->destroy($user);

        return response()->json([
            'message' => 'Restaurant has been deleted correctly',
            'error' => false
        ], Response::HTTP_OK);
    }
}
