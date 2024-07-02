<?php

namespace Modules\Voyage\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseApiController;
use Modules\Voyage\Http\Requests\VoyageExperienceStoreRequest;
use Modules\Voyage\Http\Requests\VoyageExperienceUpdateRequest;
use Modules\Voyage\Entities\Voyage;
use Modules\Voyage\Transformers\VoyageExperienceTransformer;

class VoyageExperienceController extends BaseApiController
{

    public function index($voyage_id, Request $request)
    {
        $voyage = Voyage::query()->find($voyage_id);

        if(!$voyage) {
            return $this->respondNotFound();
        }

        $voyage_experience = $voyage->voyageExperience;

        if (!$voyage_experience) {
            return $this->respondNotFound();
        }
        
        return $this->respondSuccess($this->transform($voyage_experience, new VoyageExperienceTransformer(), 'voyage_experiences'));
    }

    public function store($voyage_id, VoyageExperienceStoreRequest $request)
    {
        $voyage = Voyage::query()->find($voyage_id);

        if (!$voyage) {
            return $this->respondNotFound();
        }

        $voyage_experience = $voyage->voyageExperience()->create($request->all());

        return $this->respondSuccess($this->transform($voyage_experience, new VoyageExperienceTransformer(), 'voyage_experience'));
    }

    public function update($voyage_id, $voyage_experience_id, VoyageExperienceUpdateRequest $request)
    {
        $voyage = Voyage::query()->find($voyage_id);

        if (!$voyage) {
            return $this->respondNotFound();
        }

        $voyage_experience = $voyage->voyageExperience()->find($voyage_experience_id);

        if(!$voyage_experience) {
            return $this->respondNotFound();
        }

        $voyage_experience->update($request->all());

        return $this->respondSuccess($this->transform($voyage_experience, new VoyageExperienceTransformer(), 'voyage_experience'));
    }

    public function destroy($voyage_id, $voyage_experience_id)
    {
        $voyage = Voyage::query()->find($voyage_id);

        if (!$voyage) {
            return $this->respondNotFound();
        }

        $voyage_experience = $voyage->voyageExperience->find($voyage_experience_id);

        if (!$voyage_experience) {
            return $this->respondNotFound();
        }

        $voyage_experience->delete();

        return $this->respondSuccess();
    }
}