<?php

namespace Modules\SuiteMetadata\Http\Requests;

use App\Http\Requests\ApiFormRequest;

class SuiteMetadataUpdateRequest extends ApiFormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'image_link'=>'filled'
        ];
    }

    public function messages()
    {
        return [
            //
        ];
    }
}

