<?php

namespace Modules\Voyage\Transformers;

use League\Fractal\TransformerAbstract;
use Modules\Voyage\Entities\VoyageTimeline;

class VoyageTimelineTransformer extends TransformerAbstract
{
    public function transform(VoyageTimeline $voyage_timeline)
    {
        return [
            'id' => $voyage_timeline->id,
            'voyage_id' => $voyage_timeline->voyage_id,
            'daytime' => $voyage_timeline->daytime,
            'time' => $voyage_timeline->time,
            'detail' => $voyage_timeline->detail,
            'language' => $voyage_timeline->language,
            'created_at' => $voyage_timeline->created_at ? $voyage_timeline->created_at->toDateTimeString() : null,
            'updated_at' => $voyage_timeline->updated_at ? $voyage_timeline->updated_at->toDateTimeString() : null,
        ];
    }
}
