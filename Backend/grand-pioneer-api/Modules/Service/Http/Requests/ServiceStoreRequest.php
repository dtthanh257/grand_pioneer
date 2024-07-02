<?php

namespace Modules\Service\Http\Requests;

use App\Http\Requests\ApiFormRequest;

class ServiceStoreRequest extends ApiFormRequest
{
    public function rules()
    {
        return [
            'title' => 'required',
            'content' => 'required',
            'opening_hour' => 'required',
            'language' => 'required',
            'location' => 'required'
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
