<?php

namespace Modules\Suite\Http\Requests;

use App\Http\Requests\ApiFormRequest;

class SuiteTypeStoreRequest extends ApiFormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'=>'required',
            'language'=>'required'
        ];
    }

    public function messages()
    {
        return [
            //
        ];
    }
}

