<?php

namespace App\Services;

use App\Http\Requests\Api\UpdateAddressRequest;
use App\Http\Requests\Api\StoreAddressRequest;
use App\Models\Address;

class AddressService
{
    /**
     * @param StoreAddressRequest $request
     * @return mixed
     */
    public function create(StoreAddressRequest $request)
    {
        return Address::create($this->getAddressData($request));
    }

    /**
     * @param UpdateAddressRequest $request
     * @param string $addressUuid
     * @return bool
     */
    public function update(UpdateAddressRequest $request, string $addressUuid)
    {
        $address = Address::where('uuid', $addressUuid)->first();
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
