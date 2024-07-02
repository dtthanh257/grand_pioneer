<?php

namespace Modules\VesselMetadata\Transformers;

use League\Fractal\TransformerAbstract;
use Modules\VesselMetadata\Entities\VesselMetadata;

class VesselMetadataTransformer extends TransformerAbstract
{
    public function transform(VesselMetadata $vessel_metadata)
    {
        return [
            'id' => $vessel_metadata->id,
            'vessel_id' => $vessel_metadata->vessel_id,
            'image_link' => $vessel_metadata->image_link,
            'created_at' => $vessel_metadata->created_at ? $vessel_metadata->created_at->toDateTimeString() : null,
            'updated_at' => $vessel_metadata->updated_at ? $vessel_metadata->updated_at->toDateTimeString() : null,
        ];
    }
}
