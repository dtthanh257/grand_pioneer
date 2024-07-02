<?php

namespace Modules\Voyage\Http\Requests;

use App\Http\Requests\ApiFormRequest;

class VoyageStoreRequest extends ApiFormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title'=>'required',
            'content'=>'required',
            'summary_location'=> 'required',
            'embark'=>'required',
            'debark'=>'required',
            'fares'=>'required',
            'language' => 'required'
        ];
    }

    public function messages()
    {
        return [
            //
        ];
    }
}

