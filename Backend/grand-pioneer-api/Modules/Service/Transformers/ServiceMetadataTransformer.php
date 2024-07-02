<?php

namespace Modules\Service\Transformers;

use League\Fractal\TransformerAbstract;
use Modules\Service\Entities\ServiceMetadata;

class ServiceMetadataTransformer extends TransformerAbstract
{
    public function transform(ServiceMetadata $service_metadata)
    {
        return [
            'id' => $service_metadata->id,
            'service_id' => $service_metadata->service_id,
            'image_link' => $service_metadata->image_link,
            'created_at' => $service_metadata->created_at ? $service_metadata->created_at->toDateTimeString() : null,
            'updated_at' => $service_metadata->updated_at ? $service_metadata->updated_at->toDateTimeString() : null,
        ];
    }
}
