<?php

namespace Modules\Voyage\Transformers;

use League\Fractal\TransformerAbstract;
use Modules\Voyage\Entities\VoyageLocationMetadata;

class VoyageLocationMetadataTransformer extends TransformerAbstract
{
    public function transform(VoyageLocationMetadata $voyage_location_metadata)
    {
        return [
            'id' => $voyage_location_metadata->id,
            'voyage_location_id' => $voyage_location_metadata->voyage_location_id,
            'image_link' => $voyage_location_metadata->image_link,
            'created_at' => $voyage_location_metadata->created_at ? $voyage_location_metadata->created_at->toDateTimeString() : null,
            'updated_at' => $voyage_location_metadata->updated_at ? $voyage_location_metadata->updated_at->toDateTimeString() : null,
        ];
    }
}
