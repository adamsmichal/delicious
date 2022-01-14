<?php

namespace App\Services;

use App\Http\Requests\UpdateAddressRequest;
use App\Http\Requests\StoreAddressRequest;
use App\Models\Address;

class AddressService
{
    /**
     * @param StoreAddressRequest $request
     * @return mixed
     */
    public function store(StoreAddressRequest $request)
    {
        return Address::create($this->getAddressData($request));
    }

    /**
     * @param UpdateAddressRequest $request
     * @param Address $address
     * @return bool
     */
    public function update(UpdateAddressRequest $request, Address $address)
    {
        return $address->update($request->validated());
    }

    /**
     * @param $request
     * @return array
     */
    private function getAddressData($request)
    {
        return [
            'city' => $request->city,
            'street' => $request->street,
            'house_number' => $request->house_number,
            'flat_number' => $request->flat_number,
            'post_code' => $request->post_code,
            'country' => $request->country,
            'country_iso' => $request->country_iso
        ];
    }
}
