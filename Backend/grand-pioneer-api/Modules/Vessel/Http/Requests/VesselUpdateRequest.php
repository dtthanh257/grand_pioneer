<?php

namespace Modules\Vessel\Http\Requests;

use App\Http\Requests\ApiFormRequest;

class VesselUpdateRequest extends ApiFormRequest
{
    public function rules()
    {
        return [
            'name' => 'filled',
            'status' => 'filled',
            'inclusion' => 'filled',
            'exclusion' => 'filled',
            'language' => 'filled'
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
