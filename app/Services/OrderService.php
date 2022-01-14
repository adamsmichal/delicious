<?php

namespace App\Services;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;

class OrderService
{
    public function create(StoreOrderRequest $request)
    {
        return true;
    }

    public function update(UpdateOrderRequest $request, Order $order)
    {
        return true;
    }

    public function destroy(Order $order)
    {
        $order->delete();
    }
}
