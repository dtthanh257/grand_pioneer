<?php

namespace Modules\Voyage\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseApiController;
use Modules\Voyage\Transformers\VoyageTransformer;
use Modules\Voyage\Http\Requests\VoyageStoreRequest;
use Modules\Voyage\Http\Requests\VoyageUpdateRequest;
use Modules\Vessel\Entities\Vessel;

class VoyageController extends BaseApiController
{
    public function index($vessel_id, Request $request)
    {
        $vessel = Vessel::query()->find($vessel_id);

        if(!$vessel) {
            return $this->respondNotFound();
        }

        $voyage = $vessel->voyage;

        if (!$voyage) {
            return $this->respondNotFound();
        }
        
        return $this->respondSuccess($this->transform($voyage, new VoyageTransformer(), 'voyages'));
    }

    public function show($vessel_id, $voyage_id)
    {
        $vessel = Vessel::query()->find($vessel_id);

        if(!$vessel) {
            return $this->respondNotFound();
        }

        $voyage = $vessel->voyage()->find($voyage_id);

        if(!$voyage) {
            return $this->respondNotFound();
        }
        
        return $this->respondSuccess($this->transform($voyage, new VoyageTransformer(), 'voyage'));
    }

    public function store($vessel_id, VoyageStoreRequest $request)
    {
        $vessel = Vessel::query()->find($vessel_id);

        if (!$vessel) {
            return $this->respondNotFound();
        }

        $voyage = $vessel->voyage()->create($request->all());

        return $this->respondSuccess($this->transform($voyage, new VoyageTransformer(), 'voyage'));
    }

    public function update($vessel_id, $voyage_id, VoyageUpdateRequest $request)
    {
        $vessel = Vessel::query()->find($vessel_id);

        if (!$vessel) {
            return $this->respondNotFound();
        }

        $voyage = $vessel->voyage()->find($voyage_id);

        if(!$voyage) {
            return $this->respondNotFound();
        }

        $voyage->update($request->all());

        return $this->respondSuccess($this->transform($voyage, new VoyageTransformer(), 'voyage'));
    }

    public function destroy($vessel_id, $voyage_id)
    {
        $vessel = Vessel::query()->find($vessel_id);

        if (!$vessel) {
            return $this->respondNotFound();
        }

        $voyage = $vessel->voyage()->find($voyage_id);

        if (!$voyage) {
            return $this->respondNotFound();
        }

        $voyage->delete();

        return $this->respondSuccess();
    }
}