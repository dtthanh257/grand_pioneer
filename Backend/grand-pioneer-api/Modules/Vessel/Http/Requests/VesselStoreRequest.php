<?php

namespace Modules\Vessel\Http\Requests;

use App\Http\Requests\ApiFormRequest;

class VesselStoreRequest extends ApiFormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string',
            'status' => 'required|integer',
            'inclusion' => 'required',
            'exclusion' => 'required',
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
