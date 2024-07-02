<?php

namespace Modules\Voyage\Transformers;

use League\Fractal\TransformerAbstract;
use Modules\Voyage\Entities\VoyageLocation;

class VoyageLocationTransformer extends TransformerAbstract
{
    public function transform(VoyageLocation $voyage_location)
    {
        return [
            'id' => $voyage_location->id,
            'voyage_id' => $voyage_location->voyage_id,
            'title' => $voyage_location->title,
            'sub_title' => $voyage_location->sub_title,
            'description' => $voyage_location->description,
            'language' => $voyage_location->language,
            'created_at' => $voyage_location->created_at ? $voyage_location->created_at->toDateTimeString() : null,
            'updated_at' => $voyage_location->updated_at ? $voyage_location->updated_at->toDateTimeString() : null,
        ];
    }
}
