<?php

namespace Modules\VesselMetadata\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseApiController;
use Modules\VesselMetadata\Http\Requests\VesselMetadataStoreRequest;
use Modules\VesselMetadata\Http\Requests\VesselMetadataUpdateRequest;
use Modules\Vessel\Entities\Vessel;
use Modules\VesselMetadata\Transformers\VesselMetadataTransformer;

class VesselMetadataController extends BaseApiController
{
    public function index($vessel_id, Request $request)
    {
        $vessel = Vessel::query()->find($vessel_id);

        if(!$vessel) {
            return $this->respondNotFound();
        }

        $vessel_metadata = $vessel->vesselMetadata;

        if (!$vessel_metadata) {
            return $this->respondNotFound();
        }

        return $this->respondSuccess($this->transform($vessel_metadata, new VesselMetadataTransformer(), 'vessel_metadata'));
    }

    public function store($vessel_id, VesselMetadataStoreRequest $request)
    {
        $vessel = Vessel::query()->find($vessel_id);

        if (!$vessel) {
            return $this->respondNotFound();
        }

        $vessel_metadata = $vessel->vesselMetadata()->create($request->all());

        return $this->respondSuccess($this->transform($vessel_metadata, new VesselMetadataTransformer(), 'vessel_metadata'));
    }

    public function update($vessel_id, $vessel_metadata_id, VesselMetadataUpdateRequest $request)
    {
        $vessel = Vessel::query()->find($vessel_id);

        if (!$vessel) {
            return $this->respondNotFound();
        }

        $vessel_metadata = $vessel->vesselMetadata()->find($vessel_metadata_id);

        if(!$vessel_metadata) {
            return $this->respondNotFound();
        }

        $vessel_metadata->update($request->all());

        return $this->respondSuccess($this->transform($vessel_metadata, new VesselMetadataTransformer(), 'vessel_metadata'));
    }

    public function destroy($vessel_id, $vessel_metadata_id)
    {
        $vessel = Vessel::query()->find($vessel_id);

        if (!$vessel) {
            return $this->respondNotFound();
        }

        $vessel_metadata = $vessel->vesselMetadata()->find($vessel_metadata_id);

        if (!$vessel_metadata) {
            return $this->respondNotFound();
        }

        $vessel_metadata->delete();

        return $this->respondSuccess();
    }
}