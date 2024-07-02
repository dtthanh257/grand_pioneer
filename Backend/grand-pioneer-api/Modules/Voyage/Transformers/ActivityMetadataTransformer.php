<?php

namespace Modules\Voyage\Transformers;

use League\Fractal\TransformerAbstract;
use Modules\Voyage\Entities\ActivityMetadata;

class ActivityMetadataTransformer extends TransformerAbstract
{
    public function transform(ActivityMetadata $activity_metadata)
    {
        return [
            'id' => $activity_metadata->id,
            'activity_id' => $activity_metadata->activity_id,
            'image_link' => $activity_metadata->image_link,
            'created_at' => $activity_metadata->created_at ? $activity_metadata->created_at->toDateTimeString() : null,
            'updated_at' => $activity_metadata->updated_at ? $activity_metadata->updated_at->toDateTimeString() : null,
        ];
    }
}
