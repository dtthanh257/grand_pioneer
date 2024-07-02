<?php

namespace Modules\Suite\Transformers;

use League\Fractal\TransformerAbstract;
use Modules\Suite\Entities\Suite;

class SuiteTransformer extends TransformerAbstract
{
    public function transform(Suite $suite)
    {
        return [
            'id' => $suite->id,
            'vessel_id' => $suite->vessel_id,
            'vessel' => $suite->vessel ? $suite->vessel->name : null,
            'title' => $suite->title,
            'content' => $suite->content,
            'suite_metadata' => $suite->suiteMetadata ? $suite->suiteMetadata->map(function ($item) {
                return [
                    'image_link' => $item->image_link
                ];
            }) : null,
            'bed_number' => $suite->bed_number,
            'suite_size' => $suite->suite_size,
            'sundeck_size' => $suite->sundeck_size,
            'number_of_adult' => $suite->number_of_adult,
            'number_of_children' => $suite->number_of_children,
            'number_of_bathroom' => $suite->number_of_bathroom,
            'price' => $suite->price,
            'language' => $suite->language,
            'created_at' => $suite->created_at ? $suite->created_at->toDateTimeString() : null,
            'updated_at' => $suite->updated_at ? $suite->updated_at->toDateTimeString() : null,
        ];
    }
}
