<?php

namespace Modules\Voyage\Http\Requests;

use App\Http\Requests\ApiFormRequest;

class VoyageLocationMetadataUpdateRequest extends ApiFormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'image_link' => 'filled',
        ];
    }

    public function messages()
    {
        return [
            //
        ];
    }
}

