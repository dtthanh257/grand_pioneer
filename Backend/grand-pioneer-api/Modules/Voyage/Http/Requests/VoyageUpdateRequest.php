<?php

namespace Modules\Voyage\Http\Requests;

use App\Http\Requests\ApiFormRequest;

class VoyageUpdateRequest extends ApiFormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title'=>'filled',
            'content'=>'filled',
            'summary_location'=> 'filled',
            'embark'=>'filled',
            'debark'=>'filled',
            'fares'=>'filled',
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

