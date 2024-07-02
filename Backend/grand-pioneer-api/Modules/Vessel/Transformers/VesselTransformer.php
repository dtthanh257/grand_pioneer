<?php

namespace Modules\Vessel\Transformers;

use League\Fractal\TransformerAbstract;
use Modules\Vessel\Entities\Vessel;

class VesselTransformer extends TransformerAbstract
{
    public function transform(Vessel $vessel)
    {
        return [
            'id' => $vessel->id,
            'name' => $vessel->name,
            'status' => $vessel->status,
            'inclusion' => $vessel->inclusion,
            'exclusion' => $vessel->exclusion,
            'vessel_metadata' => $vessel->vesselMetadata ? $vessel->vesselMetadata->map(function ($item) {
                return ["image_link" => $item->image_link];
            }) : null,
            'language' => $vessel->language,
            'created_at' => $vessel->created_at ? $vessel->created_at->toDateTimeString() : null,
            'updated_at' => $vessel->updated_at ? $vessel->updated_at->toDateTimeString() : null,
        ];
    }
}
