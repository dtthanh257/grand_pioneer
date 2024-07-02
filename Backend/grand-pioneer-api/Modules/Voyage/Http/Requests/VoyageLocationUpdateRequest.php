<?php

namespace Modules\Voyage\Http\Requests;

use App\Http\Requests\ApiFormRequest;

class VoyageLocationUpdateRequest extends ApiFormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'filled',
            'sub_title' => 'filled',
            'description' => 'filled',
            'language' => 'filled'
        ];
    }

    public function messages()
    {
        return [
            //
        ];
    }
}

