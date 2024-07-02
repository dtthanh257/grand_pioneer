<?php

namespace App\Transformers\Serializer;

use League\Fractal\Serializer\ArraySerializer;

class CustomArraySerializer extends ArraySerializer
{
    /**
     * Serialize a collection to a plain array.
     *
     * @param ?string $resourceKey
     * @param array $data
     * @return array
     */
    public function collection(?string $resourceKey, array $data): array
    {
        if ($resourceKey) {
            return [$resourceKey => $data];
        }

        return $data;
    }

    /**
     * Serialize an item.
     *
     * @param ?string $resourceKey
     * @param array $data
     * @return array
     */
    public function item(?string $resourceKey, array $data): array
    {
        if ($resourceKey) {
            return [$resourceKey => $data];
        }

        return $data;
    }
}
