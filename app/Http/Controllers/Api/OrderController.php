<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\UpdateOrderRequest;
use App\Http\Requests\Api\StoreOrderRequest;
use App\Http\Resources\Api\OrderResource;
use Illuminate\Http\JsonResponse;
use App\Services\OrderService;
use Illuminate\Http\Response;

class OrderController extends ApiController
{
    /**
     * @var OrderService
     */
    private OrderService $orderService;

    /**
     * @param OrderService $orderService
     */
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * @param StoreOrderRequest $request
     * @return JsonResponse
     */
    public function store(StoreOrderRequest $request): JsonResponse
    {
        $order = $this->orderService->create($request);
        return $this->responseWithSuccess('Order has been created correctly', Response::HTTP_CREATED, OrderResource::make($order));
    }

    /**
     * @param UpdateOrderRequest $request
     * @param $orderUuid
     * @return JsonResponse
     */
    public function update(UpdateOrderRequest $request, $orderUuid): JsonResponse
    {
        $orderUpdatedCorrectly = $this->orderService->update($request, $orderUuid);

        if(!$orderUpdatedCorrectly) {
            return $this->responseWithError('Something went wrong', Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $this->responseWithSuccess('Order has been updated correctly', Response::HTTP_OK);
    }

    /**
     * @param string $orderUuid
     * @return JsonResponse
     */
    public function destroy(string $orderUuid): JsonResponse
    {
        $this->orderService->destroy($orderUuid);
        return $this->responseWithSuccess('Order has been deleted', Response::HTTP_OK);
    }
}
