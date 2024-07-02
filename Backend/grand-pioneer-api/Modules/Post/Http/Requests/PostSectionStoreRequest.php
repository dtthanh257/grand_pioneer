<?php

namespace Modules\Post\Http\Requests;

use App\Http\Requests\ApiFormRequest;

class PostSectionStoreRequest extends ApiFormRequest
{
    public function rules()
    {
        return [
            'section_name' => 'required',
            'content' => 'required',
            'image_link' => 'nullable',
            'image_name' => 'nullable',
            'language' => 'required'
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
