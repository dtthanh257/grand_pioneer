<?php

namespace Modules\SuiteMetadata\Transformers;

use League\Fractal\TransformerAbstract;
use Modules\SuiteMetadata\Entities\SuiteMetadata;

class SuiteMetadataTransformer extends TransformerAbstract
{
    public function transform(SuiteMetadata $suite_metadata)
    {
        return [
            'id' => $suite_metadata->id,
            'suite_id' => $suite_metadata->suite_id,
            'image_link' => $suite_metadata->image_link,
            'created_at' => $suite_metadata->created_at ? $suite_metadata->created_at->toDateTimeString() : null,
            'updated_at' => $suite_metadata->updated_at ? $suite_metadata->updated_at->toDateTimeString() : null,
        ];
    }
}
