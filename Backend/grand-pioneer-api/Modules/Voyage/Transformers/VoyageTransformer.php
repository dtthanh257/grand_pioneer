<?php

namespace Modules\Voyage\Transformers;

use League\Fractal\TransformerAbstract;
use Modules\Voyage\Entities\Voyage;

class VoyageTransformer extends TransformerAbstract
{
    public function transform(Voyage $voyage)
    {
        return [
            'id' => $voyage->id,
            'vessel_id' => $voyage->vessel_id,
            'vessel' => $voyage->vessel ? $voyage->vessel->name : null,
            'title' => $voyage->title,
            'content' => $voyage->content,
            'summary_location' => $voyage->summary_location,
            'embark' => $voyage->embark,
            'debark' => $voyage->debark,
            'fares' => $voyage->fares,
            'voyage_metadata' => $voyage->voyageMetadata ? $voyage->voyageMetadata->map(function ($item) {
                return [
                    'id' => $item->id,
                    'image_link' => $item->image_link
                ];
            }) : null,
            'voyage_timeline' => $voyage->voyageTimeline ? $voyage->voyageTimeline->map(function ($item) {
                return [
                    'id' => $item->id,
                    'daytime' => $item->daytime,
                    'time' => $item->time,
                    'detail' => $item->detail,
                    'language' => $item->language,
                ];
            }) : null,
            'voyage_date_available' => $voyage->voyageDateAvailable ? $voyage->voyageDateAvailable->map(function ($item) {
                return [
                    'id' => $item->id,
                    'start_date' => $item->start_date,
                    'end_date' => $item->end_date
                ];
            }) : null,
            'voyage_experience' => $voyage->voyageExperience ? $voyage->voyageExperience->map(function ($item) {
                return [
                    'id' => $item->id,
                    'review' => $item->review,
                    'language' => $item->language,
                ];
            }) : null,
            'voyage_location' => $voyage->voyageLocation ? $voyage->voyageLocation->map(function ($item) {
                return [
                    'id' => $item->id,
                    'title' => $item->title,
                    'sub_title' => $item->sub_title,
                    'description' => $item->description,
                    'voyage_location_metadata' => $item->voyageLocationMetadata ? $item->voyageLocationMetadata->map(function ($item_metadata) {
                        return [
                            'id' => $item_metadata->id,
                            'image_link' => $item_metadata->image_link
                        ];
                    }) : null,
                    'language' => $item->language,
                ];
            }) : null,
            'activities' => $voyage->activity ? $voyage->activity->map(function ($item) {
                return[
                    'id' => $item->id,
                    'title' => $item->title,
                    'content' => $item->content,
                    'activity_metadata' => $item->activityMetadata ? $item->activityMetadata->map(function ($item_metadata) {
                        return [
                            'id' => $item_metadata->id,
                            'image_link' => $item_metadata->image_link
                        ];
                    }) : null,
                    'language' => $item->language,
                ];
            }) : null,
            'language' => $voyage->language,
            'created_at' => $voyage->created_at ? $voyage->created_at->toDateTimeString() : null,
            'updated_at' => $voyage->updated_at ? $voyage->updated_at->toDateTimeString() : null,
        ];
    }
}
