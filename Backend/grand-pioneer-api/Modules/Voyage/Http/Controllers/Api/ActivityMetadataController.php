<?php

namespace Modules\Voyage\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseApiController;
use Modules\Voyage\Http\Requests\ActivityMetadataStoreRequest;
use Modules\Voyage\Transformers\ActivityMetadataTransformer;
use Modules\Voyage\Entities\Activity;
use Modules\Voyage\Http\Requests\ActivityMetadataUpdateRequest;

class ActivityMetadataController extends BaseApiController
{

    public function index($activity_id, Request $request)
    {
        $activity = Activity::query()->find($activity_id);

        if(!$activity) {
            return $this->respondNotFound();
        }

        $activity_metadata = $activity->activityMetadata;

        if (!$activity_metadata) {
            return $this->respondNotFound();
        }
        
        return $this->respondSuccess($this->transform($activity_metadata, new ActivityMetadataTransformer(), 'activity_metadatas'));
    }

    public function store($activity_id, ActivityMetadataStoreRequest $request)
    {
        $activity = Activity::query()->find($activity_id);

        if(!$activity) {
            return $this->respondNotFound();
        }

        $activity_metadata = $activity->activityMetadata()->create($request->all());

        return $this->respondSuccess($this->transform($activity_metadata, new ActivityMetadataTransformer(), 'activity_metadata'));
    }

    public function update($activity_id, $activity_metadata_id, ActivityMetadataUpdateRequest $request) {
        $activity = Activity::query()->find($activity_id);

        if (!$activity) {
            return $this->respondNotFound();
        }

        $activity_metadata = $activity->activityMetadata()->find($activity_metadata_id);

        if(!$activity_metadata) {
            return $this->respondNotFound();
        }

        $activity_metadata->update($request->all());

        return $this->respondSuccess($this->transform($activity_metadata, new ActivityMetadataTransformer(), 'activity_metadata'));
    }

    public function destroy($activity_id, $activity_metadata_id)
    {
        $activity = Activity::query()->find($activity_id);

        if(!$activity) {
            return $this->respondNotFound();
        }

        $activity_metadata = $activity->activityMetadata->find($activity_metadata_id);

        if (!$activity_metadata) {
            return $this->respondNotFound();
        }

        $activity_metadata->delete();

        return $this->respondSuccess();
    }
}