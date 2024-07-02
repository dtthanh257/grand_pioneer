<?php

namespace Modules\Voyage\Http\Requests;

use App\Http\Requests\ApiFormRequest;

class VoyageLocationMetadataStoreRequest extends ApiFormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'image_link' => 'required',
        ];
    }

    public function messages()
    {
        return [
            //
        ];
    }
}

