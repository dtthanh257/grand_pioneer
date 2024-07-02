<?php

namespace Modules\Voyage\Http\Requests;

use App\Http\Requests\ApiFormRequest;

class VoyageLocationStoreRequest extends ApiFormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required',
            'sub_title' => 'required',
            'description' => 'required',
            'language' => 'required'
        ];
    }

    public function messages()
    {
        return [
            //
        ];
    }
}

