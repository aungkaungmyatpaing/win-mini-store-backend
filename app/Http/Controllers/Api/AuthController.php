<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateAddressRequest;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Requests\Api\UpdateAddressRequest;
use App\Http\Resources\AddressResource;
use App\Models\Customer;
use App\Services\API\AuthService;
use App\Traits\ApiResponse;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use ApiResponse;

    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
    // public function login(Request $request)
    // {
    //     $phone = $request->phone;
    //     $password = $request->password;

    //     $user = Customer::where("phone", $phone)->first();

    //     if (!$user) {
    //         return $this->errorResponse([
    //             'message' => 'User Not Found'
    //         ]);
    //     }

    //     if ($user->password != Hash::check($password, $user->password)) {
    //         return $this->errorResponse([
    //             'message' => 'Password is not correct'
    //         ]);
    //     }

    //     $token = $user->createToken('access_token')->accessToken;

    //     return $this->successResponse([
    //         'token' => $token,
    //         'user' => $user
    //     ]);
    // }

    public function register(RegisterRequest $request)
    {
        $token = $this->authService->register($request->validated());
        return $this->success('Create account successful', [
            'token' => $token,
        ]);
    }

    public function login(LoginRequest $request){
        $token = $this->authService->login($request->validated());
        return $this->success('Login successful', [
            'token' => $token,
        ]);
    }

    public function createAddress(CreateAddressRequest $request)
    {
        $this->authService->createAddress($request->validated());
        return $this->success('Address create successfully');
    }

    public function updateAddress(UpdateAddressRequest $request,int $id)
    {
        $this->authService->updateAddress($request->validated(),$id);
        return $this->success('Address update successfully');
    }

    public function getAddress()
    {
        $address = $this->authService->getAddress();
        return $this->success('Get carts successfully', AddressResource::collection($address));

    }

    public function logout(){

        $this->authService->logout();
        return $this->success('Logout successful');
    }
}
