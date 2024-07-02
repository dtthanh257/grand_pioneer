<?php

namespace Modules\Suite\Transformers;

use League\Fractal\TransformerAbstract;
use Modules\Suite\Entities\SuiteType;

class SuiteTypeTransformer extends TransformerAbstract
{
    public function transform(SuiteType $suite_type)
    {
        return [
            'id' => $suite_type->id,
            'name' => $suite_type->name,
            'language' => $suite_type->language,
            'created_at' => $suite_type->created_at ? $suite_type->created_at->toDateTimeString() : null,
            'updated_at' => $suite_type->updated_at ? $suite_type->updated_at->toDateTimeString() : null,
        ];
    }
}
