<?php

namespace Modules\Suite\Http\Requests;

use App\Http\Requests\ApiFormRequest;

class SuiteStoreRequest extends ApiFormRequest
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
            'bed_number'=>'required',
            'suite_size'=>'required',
            'sundeck_size'=>'required',
            'number_of_adult'=>'required',
            'number_of_children'=>'required',
            'number_of_bathroom'=>'required',
            'price'=>'required',
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

