<?php

namespace App\Observers;

use Illuminate\Support\Str;
use App\Models\Order;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     *
     * @param Order $order
     * @return void
     */
    public function creating(Order $order)
    {
        $order->uuid = Str::uuid();
    }

}
