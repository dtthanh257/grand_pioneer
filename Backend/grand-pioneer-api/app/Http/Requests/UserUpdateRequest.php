<?php

namespace App\Http\Requests;

class UserUpdateRequest extends ApiFormRequest
{
    public function rules()
    {
        return [
            'first_name' => 'filled',
            'last_name' => 'filled',
            'role' => 'filled',
            'address' => 'filled',
            'gender' => 'filled',
            'email' => 'filled',
            'phone_number' => 'filled',
            'password' => 'filled',
        ];
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            //
        ];
    }
}
