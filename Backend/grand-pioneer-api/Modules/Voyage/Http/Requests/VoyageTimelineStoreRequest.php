<?php

namespace Modules\Voyage\Http\Requests;

use App\Http\Requests\ApiFormRequest;

class VoyageTimelineStoreRequest extends ApiFormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'daytime' => 'required',
            'time' => 'required',
            'detail' => 'required',
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

