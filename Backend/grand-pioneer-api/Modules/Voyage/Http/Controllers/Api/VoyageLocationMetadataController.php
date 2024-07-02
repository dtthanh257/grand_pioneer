<?php

namespace Modules\Voyage\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseApiController;
use Modules\Voyage\Http\Requests\VoyageLocationMetadataStoreRequest;
use Modules\Voyage\Http\Requests\VoyageLocationMetadataUpdateRequest;
use Modules\Voyage\Transformers\VoyageLocationMetadataTransformer;
use Modules\Voyage\Entities\VoyageLocation;

class VoyageLocationMetadataController extends BaseApiController
{

    public function index($voyage_location_id, Request $request)
    {
        $voyage_location = VoyageLocation::query()->find($voyage_location_id);

        if(!$voyage_location) {
            return $this->respondNotFound();
        }

        $voyage_location_metadata = $voyage_location->voyageLocationMetadata;

        if (!$voyage_location_metadata) {
            return $this->respondNotFound();
        }
        
        return $this->respondSuccess($this->transform($voyage_location_metadata, new VoyageLocationMetadataTransformer(), 'voyage_location_metadatas'));
    }

    public function store($voyage_location_id, VoyageLocationMetadataStoreRequest $request)
    {
        $voyage_location = VoyageLocation::query()->find($voyage_location_id);

        if(!$voyage_location) {
            return $this->respondNotFound();
        }

        $voyage_location_metadata = $voyage_location->voyageLocationMetadata()->create($request->all());

        return $this->respondSuccess($this->transform($voyage_location_metadata, new VoyageLocationMetadataTransformer(), 'voyage_location_metadata'));
    }

    public function update($voyage_location_id, $voyage_location_metadata_id, VoyageLocationMetadataUpdateRequest $request) {
        $voyage_location = VoyageLocation::query()->find($voyage_location_id);

        if (!$voyage_location) {
            return $this->respondNotFound();
        }

        $voyage_location_metadata = $voyage_location->voyageLocationMetadata()->find($voyage_location_metadata_id);

        if(!$voyage_location_metadata) {
            return $this->respondNotFound();
        }

        $voyage_location_metadata->update($request->all());

        return $this->respondSuccess($this->transform($voyage_location_metadata, new VoyageLocationMetadataTransformer(), 'voyage_location_metadata'));
    }

    public function destroy($voyage_location_id, $voyage_location_metadata_id)
    {
        $voyage_location = VoyageLocation::query()->find($voyage_location_id);

        if(!$voyage_location) {
            return $this->respondNotFound();
        }

        $voyage_location_metadata = $voyage_location->voyageLocationMetadata->find($voyage_location_metadata_id);

        if (!$voyage_location_metadata) {
            return $this->respondNotFound();
        }

        $voyage_location_metadata->delete();

        return $this->respondSuccess();
    }
}