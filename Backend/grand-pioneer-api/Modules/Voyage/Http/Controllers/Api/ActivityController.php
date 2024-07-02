<?php

namespace Modules\Voyage\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseApiController;
use Modules\Voyage\Http\Requests\ActivityStoreRequest;
use Modules\Voyage\Http\Requests\ActivityUpdateRequest;
use Modules\Voyage\Entities\Voyage;
use Modules\Voyage\Transformers\ActivityTransformer;
use Modules\Voyage\Repositories\ActivityRepository;

class ActivityController extends BaseApiController
{
    protected $activityRepository;

    public function __construct(ActivityRepository $activityRepository) {
        $this->activityRepository = $activityRepository;
    }

    public function index(Request $request) {
        $query = $this->activityRepository;

        $activities = $query->get();

        return $this->respondSuccess($this->transform($activities, new ActivityTransformer(), 'activities'));
    }

    public function getActivityByVoyage($voyage_id, Request $request)
    {
        $voyage = Voyage::query()->find($voyage_id);

        if(!$voyage) {
            return $this->respondNotFound();
        }

        $activity = $voyage->activity;

        if (!$activity) {
            return $this->respondNotFound();
        }
        
        return $this->respondSuccess($this->transform($activity, new ActivityTransformer(), 'activities'));
    }

    public function store($voyage_id, ActivityStoreRequest $request)
    {
        $voyage = Voyage::query()->find($voyage_id);

        if (!$voyage) {
            return $this->respondNotFound();
        }

        $activity = $voyage->activity()->create($request->all());

        return $this->respondSuccess($this->transform($activity, new ActivityTransformer(), 'activity'));
    }

    public function update($voyage_id, $activity_id, ActivityUpdateRequest $request)
    {
        $voyage = Voyage::query()->find($voyage_id);

        if (!$voyage) {
            return $this->respondNotFound();
        }

        $activity = $voyage->activity()->find($activity_id);

        if(!$activity) {
            return $this->respondNotFound();
        }

        $activity->update($request->all());

        return $this->respondSuccess($this->transform($activity, new ActivityTransformer(), 'activity'));
    }

    public function destroy($voyage_id, $activity_id)
    {
        $voyage = Voyage::query()->find($voyage_id);

        if (!$voyage) {
            return $this->respondNotFound();
        }

        $activity = $voyage->activity->find($activity_id);

        if (!$activity) {
            return $this->respondNotFound();
        }

        $activity->delete();

        return $this->respondSuccess();
    }
}