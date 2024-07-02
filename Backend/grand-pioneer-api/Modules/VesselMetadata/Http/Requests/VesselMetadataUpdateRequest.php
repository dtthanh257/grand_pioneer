<?php

namespace Modules\VesselMetadata\Http\Requests;

use App\Http\Requests\ApiFormRequest;

class VesselMetadataUpdateRequest extends ApiFormRequest
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

