<?php

namespace App\Transformers;

use App\Transformers\Serializer\CustomArraySerializer;
use Illuminate\Support\Collection as SupportCollection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use League\Fractal\Manager;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;

trait CanTransform
{
    protected function transform($data, $transformer, $resourceKey = null, $includes = [], $excludes = [])
    {
        $request = app(Request::class);

        $transformer = $transformer instanceof TransformerAbstract ? $transformer : app($transformer);

        $fractal = (new Manager())
            ->setSerializer(new CustomArraySerializer())
            ->parseIncludes($request->get('include') . ',' . (is_array($includes) ? implode(',', $includes) : $includes))
            ->parseExcludes($request->get('exclude') . ',' . (is_array($excludes) ? implode(',', $excludes) : $excludes));

        if ($data instanceof LengthAwarePaginator) {
            $result = new Collection($data->items(), $transformer, $resourceKey);
            $result->setPaginator(new IlluminatePaginatorAdapter($data));
        } elseif ($data instanceof SupportCollection || is_array($data)) {
            $result = new Collection($data, $transformer, $resourceKey);
        } else {
            $result = new Item($data, $transformer, $resourceKey);
        }

        return $fractal->createData($result)->toArray();
    }
}
