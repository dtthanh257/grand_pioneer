<?php

namespace Modules\Voyage\Transformers;

use League\Fractal\TransformerAbstract;
use Modules\Voyage\Entities\Activity;

class ActivityTransformer extends TransformerAbstract
{
    public function transform(Activity $activity)
    {
        return [
            'id' => $activity->id,
            'voyage_id' => $activity->voyage_id,
            'title' => $activity->title,
            'content' => $activity->content,
            'activity_metadata' => $activity->activityMetadata ? $activity->activityMetadata->map(function ($item) {
                return [
                    'image_link' => $item->image_link
                ];
            }) : null,
            'language' => $activity->language,
            'created_at' => $activity->created_at ? $activity->created_at->toDateTimeString() : null,
            'updated_at' => $activity->updated_at ? $activity->updated_at->toDateTimeString() : null,
        ];
    }
}
