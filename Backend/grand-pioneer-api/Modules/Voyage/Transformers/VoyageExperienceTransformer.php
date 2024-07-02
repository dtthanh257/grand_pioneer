<?php

namespace Modules\Voyage\Transformers;

use League\Fractal\TransformerAbstract;
use Modules\Voyage\Entities\VoyageExperience;

class VoyageExperienceTransformer extends TransformerAbstract
{
    public function transform(VoyageExperience $voyage_experience)
    {
        return [
            'id' => $voyage_experience->id,
            'voyage_id' => $voyage_experience->voyage_id,
            'review' => $voyage_experience->review,
            'language' => $voyage_experience->language,
            'created_at' => $voyage_experience->created_at ? $voyage_experience->created_at->toDateTimeString() : null,
            'updated_at' => $voyage_experience->updated_at ? $voyage_experience->updated_at->toDateTimeString() : null,
        ];
    }
}
