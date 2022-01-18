<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateAddressRequest;
use App\Http\Requests\StoreAddressRequest;
use App\Http\Resources\AddressResource;
use Illuminate\Http\JsonResponse;
use App\Services\AddressService;
use Illuminate\Http\Response;
use App\Models\Address;

class AddressController extends Controller
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
    public function store(StoreAddressRequest $request)
    {
        $address = $this->addressService->store($request);

        return response()->json([
            'results' => AddressResource::make($address),
            'message' => 'Address has been created correctly',
            'error' => false
        ], Response::HTTP_CREATED);
    }

    /**
     * @param $addressUuid
     * @return JsonResponse
     */
    public function show($addressUuid)
    {
        $address = Address::where('uuid', $addressUuid)->first();

        return response()->json([
            'results' => AddressResource::make($address),
            'message' => 'Address has been found',
            'error' => false
        ], Response::HTTP_OK);
    }

    /**
     * @param UpdateAddressRequest $request
     * @param $addressUuid
     * @return JsonResponse
     */
    public function update(UpdateAddressRequest $request, $addressUuid)
    {
        $address = Address::where('uuid', $addressUuid)->first();
        $addressUpdatedCorrectly = $this->addressService->update($request, $address);

        if(!$addressUpdatedCorrectly) {
            return response()->json([
                'message' => 'Something went wrong',
                'error' => true
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'message' => 'Address has been updated correctly',
            'error' => false
        ], Response::HTTP_OK);
    }
}
