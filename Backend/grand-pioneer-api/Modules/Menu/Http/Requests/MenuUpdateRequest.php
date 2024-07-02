<?php

namespace Modules\Menu\Http\Requests;

use App\Http\Requests\ApiFormRequest;

class MenuUpdateRequest extends ApiFormRequest
{
    public function rules()
    {
        return [
            'name' => 'filled',
            'title' => 'filled',
            'description' => 'filled',
            'language' => 'filled',
            'sub_title' => 'nullable',
            'sub_description' => 'nullable',
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
