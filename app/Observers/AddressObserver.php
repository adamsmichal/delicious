<?php

namespace App\Observers;

use Illuminate\Support\Str;
use App\Models\Address;

class AddressObserver
{
    /**
     * Handle the Address "created" event.
     *
     * @param Address $address
     * @return void
     */
    public function creating(Address $address)
    {
        $address->uuid = Str::uuid();
    }

}
