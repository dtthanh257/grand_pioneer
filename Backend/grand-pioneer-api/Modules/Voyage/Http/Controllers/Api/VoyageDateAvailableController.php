<?php

namespace Modules\Voyage\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseApiController;
use Modules\Voyage\Http\Requests\VoyageDateAvailableStoreRequest;
use Modules\Voyage\Entities\Voyage;
use Modules\Voyage\Transformers\VoyageDateAvailableTransformer;

class VoyageDateAvailableController extends BaseApiController
{
    public function index($voyage_id, Request $request)
    {
        $voyage = Voyage::query()->find($voyage_id);

        if(!$voyage) {
            return $this->respondNotFound();
        }

        $voyage_date_available = $voyage->voyageDateAvailable;

        if (!$voyage_date_available) {
            return $this->respondNotFound();
        }
        
        return $this->respondSuccess($this->transform($voyage_date_available, new VoyageDateAvailableTransformer(), 'voyage_date_availables'));
    }

    public function store($voyage_id, VoyageDateAvailableStoreRequest $request)
    {
        $voyage = Voyage::query()->find($voyage_id);

        if (!$voyage) {
            return $this->respondNotFound();
        }

        $voyage_date_available = $voyage->voyageDateAvailable()->create($request->all());

        return $this->respondSuccess($this->transform($voyage_date_available, new VoyageDateAvailableTransformer(), 'voyage_date_available'));
    }

    public function update($voyage_id, $voyage_date_available_id, VoyageDateAvailableUpdateRequest $request)
    {
        $voyage = Voyage::query()->find($voyage_id);

        if (!$voyage) {
            return $this->respondNotFound();
        }

        $voyage_date_available = $voyage->voyageDateAvailable()->find($voyage_date_available_id);

        if(!$voyage_date_available) {
            return $this->respondNotFound();
        }

        $voyage_date_available->update($request->all());

        return $this->respondSuccess($this->transform($voyage_date_available, new VoyageDateAvailableTransformer(), 'voyage_date_$voyage_date_available'));
    }

    public function destroy($voyage_id, $voyage_date_available_id)
    {
        $voyage = Voyage::query()->find($voyage_id);

        if (!$voyage) {
            return $this->respondNotFound();
        }

        $voyage_date_available = $voyage->voyageDateAvailable->find($voyage_date_available_id);

        if (!$voyage_date_available) {
            return $this->respondNotFound();
        }

        $voyage_date_available->delete();

        return $this->respondSuccess();
    }
}