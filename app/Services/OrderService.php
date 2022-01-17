<?php

namespace App\Services;

use App\Http\Requests\UpdateOrderRequest;
use App\Http\Requests\StoreOrderRequest;
use App\Enums\OrderPaymentStatusEnum;
use App\Models\Order;

class OrderService
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function create(StoreOrderRequest $request)
    {
        return Order::create($this->getOrderData($request));
    }

    public function update(UpdateOrderRequest $request, Order $order)
    {
        return $order->update($request->validated());
    }

    public function destroy(Order $order)
    {
        $order->delete();
    }

    private function getOrderData(StoreOrderRequest $request)
    {
        return [
            'user_id' => $this->userService->getId($request->userUuid),
            'address_id' => $request->address_id,
            'notes' => $request->notes,
            'payment_status' => OrderPaymentStatusEnum::NOT_PAID,
            'payment_date' => now(),
//            'products_price' =>
//            'shipment_price' =>
//            'total_price' =>
            'currency' => $request->currency,
            'transaction_number' => null,
//            'payment_method_id' =>
//            'discount_id' =>
        ];
    }
}
