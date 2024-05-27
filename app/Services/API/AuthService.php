<?php

namespace App\Services\API;

use App\Exceptions\CreateDataFailException;
use App\Exceptions\RegistrationFailException;
use App\Exceptions\ResourceForbiddenException;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

class AuthService
{
    public function register(array $requestArray): string
    {
        DB::beginTransaction();
        try {
            $user = Customer::create($requestArray);
            $token = $user->createToken('USER-AUTH-TOKEN')->plainTextToken;
            DB::commit();
            return $token;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new RegistrationFailException('Failed to register user');
        }
    }

    public function login(array $requestArray): string
    {
        $user = Customer::where('phone', $requestArray['phone'])->first();

        if (is_null($user)) {
            throw new ResourceNotFoundException('Phone number or user not found');
        }

        if (!Hash::check($requestArray['password'], $user->password)) {
            throw new ResourceForbiddenException('Phone number or password is incorrect');
        }

        if ($user->is_banned == 1) {
            throw new ResourceForbiddenException('Your account has been banned');
        }

        return $user->createToken('USER-AUTH-TOKEN')->plainTextToken;
    }

    public function createAddress(array $requestArray)
    {
        $customer = Auth::guard('customer')->user();
        $customer->address()->create([
            'address' => $requestArray['address'],
            'name' => $requestArray['name'],
            'phone' => $requestArray['phone'],
            'township_id' => $requestArray['township_id'],
            'address_type' => $requestArray['address_type'],
        ]);
    }

    public function updateAddress(array $requestArray, $id)
    {
        $customer = Auth::guard('customer')->user();

        $address = $customer->address()->find($id);
        if (!$address) {
            throw new ResourceForbiddenException('Old Address not found');
        }
        // Update the attributes of the address
        try {

            $address->address = $requestArray['address'];
            $address->name = $requestArray['name'];
            $address->phone = $requestArray['phone'];
            $address->township_id = $requestArray['township_id'];
            $address->address_type = $requestArray['address_type'];
            $address->save();
        } catch (\Throwable $th) {
            throw new CreateDataFailException('Failed to update cart');
        }
    }

    public function getAddress()
    {
        $customer = Auth::guard('customer')->user();
        return $customer->address;
    }

    public function logout(){

        $customer = Auth::guard('customer')->user();
        $customer->tokens()->where('name', $customer->currentAccessToken()->name)->delete();

    }
}
