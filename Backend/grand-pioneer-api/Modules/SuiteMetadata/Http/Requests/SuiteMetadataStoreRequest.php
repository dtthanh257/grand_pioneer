<?php

namespace Modules\SuiteMetadata\Http\Requests;

use App\Http\Requests\ApiFormRequest;

class SuiteMetadataStoreRequest extends ApiFormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'image_link'=>'required'
        ];
    }

    public function messages()
    {
        return [
            //
        ];
    }
}

