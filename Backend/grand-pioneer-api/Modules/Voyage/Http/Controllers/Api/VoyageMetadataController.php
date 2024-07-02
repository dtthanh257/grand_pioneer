<?php

namespace Modules\Voyage\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseApiController;
use Modules\Voyage\Http\Requests\VoyageMetadataStoreRequest;
use Modules\Voyage\Http\Requests\VoyageMetadataUpdateRequest;
use Modules\Voyage\Entities\Voyage;
use Modules\Voyage\Transformers\VoyageMetadataTransformer;

class VoyageMetadataController extends BaseApiController
{

    public function index($voyage_id, Request $request)
    {
        $voyage = Voyage::query()->find($voyage_id);

        if(!$voyage) {
            return $this->respondNotFound();
        }

        $voyage_metadata = $voyage->voyageMetadata;

        if (!$voyage_metadata) {
            return $this->respondNotFound();
        }
        
        return $this->respondSuccess($this->transform($voyage_metadata, new VoyageMetadataTransformer(), 'voyage_metadatas'));
    }

    public function store($voyage_id, VoyageMetadataStoreRequest $request)
    {
        $voyage = Voyage::query()->find($voyage_id);

        if (!$voyage) {
            return $this->respondNotFound();
        }

        $voyage_metadata = $voyage->voyageMetadata()->create($request->all());

        return $this->respondSuccess($this->transform($voyage_metadata, new VoyageMetadataTransformer(), 'voyage_metadata'));
    }

    public function update($voyage_id, $voyage_metadata_id, VoyageMetadataUpdateRequest $request) {
        $voyage = Voyage::query()->find($voyage_id);

        if (!$voyage) {
            return $this->respondNotFound();
        }

        $voyage_metadata = $voyage->voyageMetadata()->find($voyage_metadata_id);

        if(!$voyage_metadata) {
            return $this->respondNotFound();
        }

        $voyage_metadata->update($request->all());

        return $this->respondSuccess($this->transform($voyage_metadata, new VoyageMetadataTransformer(), 'voyage_metadata'));
    }

    public function destroy($voyage_id, $voyage_metadata_id)
    {
        $voyage = Voyage::query()->find($voyage_id);

        if (!$voyage) {
            return $this->respondNotFound();
        }

        $voyage_metadata = $voyage->voyageMetadata->find($voyage_metadata_id);

        if (!$voyage_metadata) {
            return $this->respondNotFound();
        }

        $voyage_metadata->delete();

        return $this->respondSuccess();
    }
}