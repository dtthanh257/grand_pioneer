<?php

namespace Modules\Service\Http\Requests;

use App\Http\Requests\ApiFormRequest;

class ServiceMetadataStoreRequest extends ApiFormRequest
{
    public function rules()
    {
        return [
            'image_link' => 'required'
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
