<?php

namespace Modules\Post\Http\Requests;

use App\Http\Requests\ApiFormRequest;

class PostUpdateRequest extends ApiFormRequest
{
    public function rules()
    {
        return [
            'title' => 'filled',
            'description' => 'filled',
            'thumbnail' => 'filled',
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
