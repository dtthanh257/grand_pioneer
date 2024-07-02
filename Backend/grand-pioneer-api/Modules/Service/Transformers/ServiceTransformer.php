<?php

namespace Modules\Service\Transformers;

use League\Fractal\TransformerAbstract;
use Modules\Service\Entities\Service;

class ServiceTransformer extends TransformerAbstract
{
    public function transform(Service $service)
    {
        return [
            'id' => $service->id,
            'vessel_id' => $service->vessel_id,
            'vessel' => $service->vessel ? $service->vessel->name : "",
            'title' => $service->title,
            'content' => $service->content,
            'opening_hour' => $service->opening_hour,
            'location' => $service->location,
            'service_metadata' => $service->serviceMetadata ? $service->serviceMetadata->map(function ($item) {
                return [
                    'image_link' => $item->image_link
                ];
            }) : null,
            'created_at' => $service->created_at ? $service->created_at->toDateTimeString() : null,
            'updated_at' => $service->updated_at ? $service->updated_at->toDateTimeString() : null,
        ];
    }
}
