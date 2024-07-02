<?php

namespace App\Http\Requests;

class UserStoreRequest extends ApiFormRequest
{
    public function rules()
    {
        return [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'address' => 'nullable',
            'role' => 'required|integer',
            'gender' => 'required|integer',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'required',
            'password' => 'required|string|min:8|confirmed',
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
