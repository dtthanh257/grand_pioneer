<?php

namespace Modules\Voyage\Http\Requests;

use App\Http\Requests\ApiFormRequest;

class VoyageTimelineUpdateRequest extends ApiFormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'daytime' => 'filled',
            'time' => 'filled',
            'detail' => 'filled',
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

