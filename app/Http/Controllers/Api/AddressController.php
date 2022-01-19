<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\UpdateAddressRequest;
use App\Http\Requests\Api\StoreAddressRequest;
use App\Http\Resources\Api\AddressResource;
use Illuminate\Http\JsonResponse;
use App\Services\AddressService;
use Illuminate\Http\Response;
use App\Models\Address;

class AddressController extends ApiController
{
    /**
     * @var AddressService
     */
    private AddressService $addressService;

    /**
     * @param AddressService $addressService
     */
    public function __construct(AddressService $addressService)
    {
        $this->addressService = $addressService;
    }

    /**
     * @param StoreAddressRequest $request
     * @return JsonResponse
     */
    public function store(StoreAddressRequest $request): JsonResponse
    {
        $address = $this->addressService->create($request);
        return $this->responseWithSuccess('Address has been created correctly', Response::HTTP_CREATED, AddressResource::make($address));
    }

    /**
     * @param $addressUuid
     * @return JsonResponse
     */
    public function show($addressUuid): JsonResponse
    {
        $address = Address::where('uuid', $addressUuid)->first();
        return $this->responseWithSuccess('Address has been found', Response::HTTP_OK, AddressResource::make($address));
    }

    /**
     * @param UpdateAddressRequest $request
     * @param string $addressUuid
     * @return JsonResponse
     */
    public function update(UpdateAddressRequest $request, string $addressUuid): JsonResponse
    {
        $addressUpdatedCorrectly = $this->addressService->update($request, $addressUuid);

        if(!$addressUpdatedCorrectly) {
            return $this->responseWithError('Something went wrong', Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $this->responseWithSuccess('Address has been updated correctly', Response::HTTP_OK);
    }
}
