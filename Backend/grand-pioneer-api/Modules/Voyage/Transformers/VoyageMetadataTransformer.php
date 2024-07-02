<?php

namespace Modules\Voyage\Transformers;

use League\Fractal\TransformerAbstract;
use Modules\Voyage\Entities\VoyageMetadata;

class VoyageMetadataTransformer extends TransformerAbstract
{
    public function transform(VoyageMetadata $voyage_metadata)
    {
        return [
            'id' => $voyage_metadata->id,
            'voyage_id' => $voyage_metadata->voyage_id,
            'image_link' => $voyage_metadata->image_link,
            'created_at' => $voyage_metadata->created_at ? $voyage_metadata->created_at->toDateTimeString() : null,
            'updated_at' => $voyage_metadata->updated_at ? $voyage_metadata->updated_at->toDateTimeString() : null,
        ];
    }
}
