<?php

namespace Modules\Voyage\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseApiController;
use Modules\Voyage\Http\Requests\VoyageLocationStoreRequest;
use Modules\Voyage\Http\Requests\VoyageLocationUpdateRequest;
use Modules\Voyage\Entities\Voyage;
use Modules\Voyage\Transformers\VoyageLocationTransformer;

class VoyageLocationController extends BaseApiController
{

    public function index($voyage_id, Request $request)
    {
        $voyage = Voyage::query()->find($voyage_id);

        if(!$voyage) {
            return $this->respondNotFound();
        }

        $voyage_location = $voyage->voyageLocation;

        if (!$voyage_location) {
            return $this->respondNotFound();
        }
        
        return $this->respondSuccess($this->transform($voyage_location, new VoyageLocationTransformer(), 'voyage_locations'));
    }

    public function store($voyage_id, VoyageLocationStoreRequest $request)
    {
        $voyage = Voyage::query()->find($voyage_id);

        if (!$voyage) {
            return $this->respondNotFound();
        }

        $voyage_location = $voyage->voyageLocation()->create($request->all());

        return $this->respondSuccess($this->transform($voyage_location, new VoyageLocationTransformer(), 'voyage_location'));
    }


    public function update($voyage_id, $voyage_location_id, VoyageLocationUpdateRequest $request)
    {
        $voyage = Voyage::query()->find($voyage_id);

        if (!$voyage) {
            return $this->respondNotFound();
        }

        $voyage_location = $voyage->voyageLocation()->find($voyage_location_id);

        if(!$voyage_location) {
            return $this->respondNotFound();
        }

        $voyage_location->update($request->all());

        return $this->respondSuccess($this->transform($voyage_location, new VoyageLocationTransformer(), 'voyage_location'));
    }

    public function destroy($voyage_id, $voyage_location_id)
    {
        $voyage = Voyage::query()->find($voyage_id);

        if (!$voyage) {
            return $this->respondNotFound();
        }

        $voyage_location = $voyage->voyageLocation->find($voyage_location_id);

        if (!$voyage_location) {
            return $this->respondNotFound();
        }

        $voyage_location->delete();

        return $this->respondSuccess();
    }
}