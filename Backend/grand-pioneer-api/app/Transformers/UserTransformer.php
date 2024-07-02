<?php

namespace App\Transformers;

use App\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    public function transform(User $user)
    {
        return [
            'id' => $user->id,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'phone_number' => $user->phone_number,
            'gender' => $user->gender,
            'address' => $user->address,
            'role' => $user->role,
            'created_at' => $user->created_at ? $user->created_at->toDateTimeString() : null,
            'updated_at' => $user->updated_at ? $user->updated_at->toDateTimeString() : null,
        ];
    }
}
