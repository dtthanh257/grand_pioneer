<?php

namespace App\Http\Controllers\Api;

use App\Repositories\UserRepository;
use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\UserStoreRequest;
use App\Transformers\UserTransformer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class RegisterController extends BaseApiController
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(UserStoreRequest $request)
    {
        $data = $request->only(['first_name', 'last_name', 'address', 'role', 'gender', 'email', 'password', 'phone_number']);

        if($request->has('password'))
        {
            $data['password'] = Hash::make($request->input('password'));
        }

        $user = $this->userRepository->create($data);
        $user->refresh();

        return $this->respondSuccess($this->transform($user, new UserTransformer(), 'user'));
    }
}