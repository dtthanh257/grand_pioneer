<?php

namespace Modules\Voyage\Http\Requests;

use App\Http\Requests\ApiFormRequest;

class VoyageExperienceUpdateRequest extends ApiFormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'review' => 'filled',
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

