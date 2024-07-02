<?php

namespace Modules\Voyage\Transformers;

use League\Fractal\TransformerAbstract;
use Modules\Voyage\Entities\VoyageDateAvailable;

class VoyageDateAvailableTransformer extends TransformerAbstract
{
    public function transform(VoyageDateAvailable $voyage_date_available)
    {
        return [
            'id' => $voyage_date_available->id,
            'voyage_id' => $voyage_date_available->voyage_id,
            'start_date' => $voyage_date_available->start_date,
            'end_date' => $voyage_date_available->end_date,
            'created_at' => $voyage_date_available->created_at ? $voyage_date_available->created_at->toDateTimeString() : null,
            'updated_at' => $voyage_date_available->updated_at ? $voyage_date_available->updated_at->toDateTimeString() : null,
        ];
    }
}
