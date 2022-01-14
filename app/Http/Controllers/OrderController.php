<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateOrderRequest;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Resources\OrderResource;
use Illuminate\Http\JsonResponse;
use App\Services\OrderService;
use Illuminate\Http\Response;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * @var OrderService
     */
    protected OrderService $orderService;

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
    public function store(StoreOrderRequest $request)
    {
        $order = $this->orderService->create($request);

        return response()->json([
            'results' => OrderResource::make($order),
            'message' => 'Order has been created correctly',
            'error' => false
        ], Response::HTTP_CREATED);
    }

    /**
     * @param UpdateOrderRequest $request
     * @param $orderUuid
     * @return JsonResponse
     */
    public function update(UpdateOrderRequest $request, $orderUuid)
    {
        $order = Order::where('uuid', $orderUuid)->first();
        $orderUpdatedCorrectly = $this->orderService->update($request, $order);

        if(!$orderUpdatedCorrectly) {
            return response()->json([
                'message' => 'Something went wrong',
                'error' => true
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'message' => 'Order has been updated correctly',
            'error' => false
        ], Response::HTTP_OK);
    }

    /**
     * @param $orderUuid
     * @return JsonResponse
     */
    public function destroy($orderUuid)
    {
        $order = Order::where('uuid', $orderUuid)->first();
        $this->orderService->destroy($order);

        return response()->json([
            'message' => 'Order has been deleted',
            'error' => false
        ], Response::HTTP_OK);
    }
}
