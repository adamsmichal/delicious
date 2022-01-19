<?php

namespace App\Services;

use App\Http\Requests\Api\UpdateOrderRequest;
use App\Http\Requests\Api\StoreOrderRequest;
use App\Enums\OrderPaymentStatusEnum;
use App\Models\Order;

class OrderService
{
    /**
     * @var UserService
     */
    private UserService $userService;

    /**
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param StoreOrderRequest $request
     * @return mixed
     */
    public function create(StoreOrderRequest $request)
    {
        return Order::create($this->getOrderData($request));
    }

    /**
     * @param UpdateOrderRequest $request
     * @param string $orderUuid
     * @return bool
     */
    public function update(UpdateOrderRequest $request, string $orderUuid)
    {
        $order = Order::where('uuid', $orderUuid)->first();
        return $order->update($request->validated());
    }

    /**
     * @param string $orderUuid
     */
    public function destroy(string $orderUuid)
    {
        $order = Order::where('uuid', $orderUuid)->first();
        $order->delete();
    }

    /**
     * @param StoreOrderRequest $request
     * @return array
     */
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
