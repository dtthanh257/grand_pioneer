<?php

namespace Modules\Post\Http\Requests;

use App\Http\Requests\ApiFormRequest;

class PostStoreRequest extends ApiFormRequest
{
    public function rules()
    {
        return [
            'title' => 'required',
            'description' => 'required',
            'thumbnail' => 'required',
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
