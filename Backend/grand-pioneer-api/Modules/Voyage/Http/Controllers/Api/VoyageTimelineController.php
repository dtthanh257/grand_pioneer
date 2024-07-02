<?php

namespace Modules\Voyage\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseApiController;
use Modules\Voyage\Http\Requests\VoyageTimelineStoreRequest;
use Modules\Voyage\Http\Requests\VoyageTimelineUpdateRequest;
use Modules\Voyage\Entities\Voyage;
use Modules\Voyage\Transformers\VoyageTimelineTransformer;

class VoyageTimelineController extends BaseApiController
{

    public function index($voyage_id, Request $request)
    {
        $voyage = Voyage::query()->find($voyage_id);

        if(!$voyage) {
            return $this->respondNotFound();
        }

        $voyage_timeline = $voyage->voyageTimeline;

        if (!$voyage_timeline) {
            return $this->respondNotFound();
        }
        
        return $this->respondSuccess($this->transform($voyage_timeline, new VoyageTimelineTransformer(), 'voyage_timelines'));
    }

    public function store($voyage_id, VoyageTimelineStoreRequest $request)
    {
        $voyage = Voyage::query()->find($voyage_id);

        if (!$voyage) {
            return $this->respondNotFound();
        }

        $voyage_timeline = $voyage->voyageTimeline()->create($request->all());

        return $this->respondSuccess($this->transform($voyage_timeline, new VoyageTimelineTransformer(), 'voyage_timeline'));
    }

        public function update($voyage_id, $voyage_timeline_id, VoyageTimelineUpdateRequest $request)
    {
        $voyage = Voyage::query()->find($voyage_id);

        if (!$voyage) {
            return $this->respondNotFound();
        }

        $voyage_timeline = $voyage->voyageTimeline()->find($voyage_timeline_id);

        if(!$voyage_timeline) {
            return $this->respondNotFound();
        }

        $voyage_timeline->update($request->all());

        return $this->respondSuccess($this->transform($voyage_timeline, new VoyageTimelineTransformer(), 'voyage_timeline'));
    }

    public function destroy($voyage_id, $voyage_timeline_id)
    {
        $voyage = Voyage::query()->find($voyage_id);

        if (!$voyage) {
            return $this->respondNotFound();
        }

        $voyage_timeline = $voyage->voyageTimeline->find($voyage_timeline_id);

        if (!$voyage_timeline) {
            return $this->respondNotFound();
        }

        $voyage_timeline->delete();

        return $this->respondSuccess();
    }
}