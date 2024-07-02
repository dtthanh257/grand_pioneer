<?php

namespace Modules\Post\Http\Requests;

use App\Http\Requests\ApiFormRequest;

class PostSectionUpdateRequest extends ApiFormRequest
{
    public function rules()
    {
        return [
            'section_name' => 'filled',
            'content' => 'filled',
            'image_link' => 'nullable',
            'image_name' => 'nullable',
            'language' => 'filled'
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
