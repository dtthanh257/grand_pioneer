<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Repositories\Criteria\UserRequestCriteria;
use App\Transformers\UserTransformer;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends BaseApiController
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(Request $request)
    {
        $query = $this->userRepository;
        
        $users = $query->get();

        return $this->respondSuccess($this->transform($users, new UserTransformer(), 'users'));
    }

    public function show($id)
    {
        $user = $this->userRepository->find($id);

        return $this->respondSuccess($this->transform($user, new UserTransformer(), 'user'));
    }

    public function update($id, UserUpdateRequest $request)
    {
        $user = $this->userRepository->find($id);

        $data = $request->only(['first_name', 'last_name', 'email', 'address', 'gender', 'role', 'phone_number']);

        if($request->has('password'))
        {
            $data['password'] = Hash::make($request->input('password'));
        }

        $user->update($data);
        $user->refresh();

        return $this->respondSuccess($this->transform($user, new UserTransformer(), 'user'));
    }

    public function resetPassword($id)
    {
        $user = $this->userRepository->find($id);

        $user->password = Hash::make('123456');
        $user->save();

        return $this->respondSuccess($this->transform($user, new UserTransformer(), 'user'));
    }

    public function destroy($id) {
        $user = $this->userRepository->find($id);

        if(!$user) {
            return $this->respondNotFound();
        }

        $user->delete();

        return $this->respondSuccess();
    }
}