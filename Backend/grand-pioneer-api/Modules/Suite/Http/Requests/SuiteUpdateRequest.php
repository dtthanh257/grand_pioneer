<?php

namespace Modules\Suite\Http\Requests;

use App\Http\Requests\ApiFormRequest;

class SuiteUpdateRequest extends ApiFormRequest
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
            'bed_number'=>'filled',
            'suite_size'=>'filled',
            'sundeck_size'=>'filled',
            'number_of_adult'=>'filled',
            'number_of_children'=>'filled',
            'number_of_bathroom'=>'filled',
            'price'=>'filled',
            'language'=>'filled'
        ];
    }

    public function messages()
    {
        return [
            //
        ];
    }
}

