<?php

namespace Modules\Menu\Http\Requests;

use App\Http\Requests\ApiFormRequest;

class MenuStoreRequest extends ApiFormRequest
{
    public function rules()
    {
        return [
            'name' => 'required',
            'title' => 'required',
            'description' => 'required',
            'language' => 'required',
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
