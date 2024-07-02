<?php

namespace Modules\VesselMetadata\Http\Requests;

use App\Http\Requests\ApiFormRequest;

class VesselMetadataStoreRequest extends ApiFormRequest
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

