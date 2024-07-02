<?php

namespace Modules\Service\Http\Requests;

use App\Http\Requests\ApiFormRequest;

class ServiceMetadataUpdateRequest extends ApiFormRequest
{
    public function rules()
    {
        return [
            'image_link' => 'filled'
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
