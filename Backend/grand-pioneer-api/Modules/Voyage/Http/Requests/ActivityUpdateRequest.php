<?php

namespace Modules\Voyage\Http\Requests;

use App\Http\Requests\ApiFormRequest;

class ActivityUpdateRequest extends ApiFormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'filled',
            'content' => 'filled',
            'language' => 'filled'
        ];
    }

    public function messages()
    {
        return [
            //
        ];
    }
}

