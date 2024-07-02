<?php

namespace Modules\Service\Http\Requests;

use App\Http\Requests\ApiFormRequest;

class ServiceUpdateRequest extends ApiFormRequest
{
    public function rules()
    {
        return [
            'title' => 'filled',
            'content' => 'filled',
            'opening_hour' => 'filled',
            'location' => 'filled',
            'language' => 'required'
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
