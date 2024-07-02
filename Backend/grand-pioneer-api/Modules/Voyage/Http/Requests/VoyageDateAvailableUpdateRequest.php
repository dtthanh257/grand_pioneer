<?php

namespace Modules\Voyage\Http\Requests;

use App\Http\Requests\ApiFormRequest;

class VoyageDateAvailableUpdateRequest extends ApiFormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'start_date' => 'filled',
            'end_date' => 'filled'
        ];
    }

    public function messages()
    {
        return [
            //
        ];
    }
}

